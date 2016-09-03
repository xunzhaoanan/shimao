<?php
/**
 * Author: Chenmh
 * Date: 2015/8/21
 * Time: 13:30
 */

namespace common\helpers;
use Yii;
use common\models\BaseModel;

/**
 * 权限提取相关
 * Class AuthCollect
 * @package app\common\helpers
 */
class AuthCollect
{

    private $_err = null;
    private $system = null;//所属系统值
    private $igPages = null;//不处理的页面

    function __construct($system, $igPages = array())
    {
        $this->igPages = $igPages;
        $this->system = $system;
    }


    /**
     * 根据地址获取相应的类方法（未在数据库里面）
     * @param $filePath
     * @return array
     */
    public function getList($filePath)
    {
        //获取目录的文件夹地址
        $filesnames = scandir($filePath);
        $ret = array();
        //遍历所有文件
        foreach ($filesnames as $name) {
            if (strstr($name, '.php', $name) === false)//只处理php
                continue;
            if (in_array($name, $this->igPages))
                continue;
            $className = str_replace('Controller.php', '', $name);//获取类名
            $funcs = $this->dealFile($filePath . DS . $name, $className);
            if (empty($funcs))//如果无方法则不处理
                continue;
            $ret[] = $funcs;
        }
        return $ret;
    }

    /**
     * 保存权限节点设置
     * @return array
     */
    public function saveData($postData)
    {
        $datas = json_decode($postData, true);
        $classId = "";
        $funcs = array();
        foreach ($datas as $row) {
            if ($row['t'] == "1") {//说明是类
                $classId = $row['cId'];
                if ($classId) {//说明已经在数据库了
                    continue;
                }
                //需要创建
                $info = $this->createClass($row['c'], $row['r'], 1);
                if ($info === false)
                    continue;
                $classId = $info['id'];
            } else {//说明是方法
                if (empty($classId)) {//说明其父亲添加失败，则其也不能添加
                    continue;
                }
                $funcs[] = array('class_id' => $classId, 'name' => $row['a'], 'remark' => $row['r'], 'sort' => $row['s'], 'system' => $this->system, 'menus' => $row['m'], 'sync' => $row['sync']);
            }
        }
        //批量插入
        if (!empty($funcs)) {
            $this->batchCreateFunc($funcs);
        }
    }


    /**
     * 处理单个文件，获取类名，方法名和备注
     * @param $filePath
     * @param $className
     * @return array
     */
    private function dealFile($filePath, $className)
    {
        $content = file_get_contents($filePath);
//        $pattern = '/(\{[\s\S]*\/\**[\s\S]*?public function action.*\(\))/';
//        preg_match($pattern, $content, $matches);
//        if (empty($matches)) {//无则返回空
//            return array();
//        }
        //获取类名
        $className = $this->parseClass($className);
        //判断是否存在
        $classInfo = $this->getClassInfo($className);
        if ($classInfo === false)//接口错误
            return array();
        if ($classInfo === null) {//说明数据还不存在
            $classArr = array('id' => null, 'name' => $className, 'remark' => '');
            $classFuncArr = array();
        } else {
            $classFuncArr = $this->getClassFunc($classInfo['id']);
            if ($classFuncArr === false)//接口错误
                return array();
            $classArr = $classInfo;
        }
        $ret = array();
        $pattern2 = '/.*public function action(.*)/';
        preg_match_all($pattern2, $content, $matches2);
        if (count($matches2[0])) {
            foreach ($matches2[0] as $val) {
                preg_match('/.*public function action(.*)/', $val, $matches3);
                //方法名
                $funcName = $this->parseFunction($matches3[1]);
                //判断是否已经存在
                if ($this->checkFuncExist($classFuncArr, $funcName))
                    continue;
                $ret[$funcName] = $funcName;
            }
        }
        if (empty($ret))//如果无则不展示
            return array();
        $classArr['func'] = $ret;
        return $classArr;
    }

    /**
     * 获取方法名
     * @param $str
     * @return string
     */
    private function parseFunction($str)
    {
        $str = lcfirst($str);
        $pos = strpos($str,'(');
        if($pos != -1)
        {
        	$str = substr($str, 0,$pos);
        }
        $ret = '';
        for ($i = 0; $i < strlen($str); $i++) {
            if (ord($str[$i]) >= 65 && ord($str[$i]) <= 90) {
                $ret .= '-' . strtolower($str[$i]);
            } else {
                $ret .= $str[$i];
            }
        }
        return $ret;
    }

    /**
     * 获取类名
     * @param $str
     * @return string
     */
    private function parseClass($str)
    {
        $str = lcfirst($str);
        $ret = '';
        for ($i = 0; $i < strlen($str); $i++) {
            if (ord($str[$i]) >= 65 && ord($str[$i]) <= 90) {
                $ret .= '-' . strtolower($str[$i]);
            } else {
                $ret .= $str[$i];
            }
        }
        return $ret;
    }

    /**
     * 提取方法描述
     * @param $str
     * @return string
     */
    private function parseDescription($str, $func)
    {
        /*$str1 = str_replace(array("\r\n", "\n", "\r"), '', $str);
        $str2 = substr($str1, 10);
        return substr($str2, 0, strpos($str2, '*'));*/
		
    	$pos = strpos($func,'(');
    	if($pos != -1)
    	{
    		$func = substr($func, 0,$pos);
    	}
        $rule = '/\/\**\s+?\*([^\n\r]+)\s+[^\{]+(public)*\s+function\s+action' . $func . '/i';
        preg_match($rule, $str, $result);
        $back = '';
        //新格式的注释
        if(empty($result))
        {
            $apiDocRule = '/\*\s+@api\s+\{[a-zA-Z]+\}\s+\/[a-zA-Z\/\-0-9]+\s[0-9]{1,4}\.(.*)/';
            preg_match($apiDocRule, $str, $result);
        }
        if (!empty($result))
            $back = trim($result[1]);
        return $back;
    }


    /**
     * 获取类信息，是否存在，存在返回对应信息
     * @param $name
     * @return bool|null
     */
    private function getClassInfo($name)
    {
        $pData = array('name' => $name, 'system' => $this->system);
        $back = $this->runCall('auth-get-class-info', $pData);
        if ($back === false) {
            $err = $this->_err;
            if (!empty($err) && $err['errcode'] === 33002) {//说明数据不存在
                return null;
            }
            return false;//接口报错
        }
        return $back;
    }


    /**
     * 获取类下面的方法
     * @param $classId
     * @return bool|null
     */
    private function getClassFunc($classId)
    {
        $pData = array('id' => $classId);
        $back = $this->runCall('auth-get-class', $pData);
        if ($back === false) {
            $err = $this->_err;
            if (!empty($err) && $err['errcode'] === 33002) {//说明数据不存在
                return null;
            }
            return false;//接口报错
        }
        return $back['authFunction'];
    }

    /**
     * 检测方法名是否已经在数据库存在
     * @param $funs
     * @param $name
     * @return bool
     */
    private function checkFuncExist($funs, $name)
    {
        if (empty($funs))
            return false;
        foreach ($funs as $fun) {
            if ($fun['name'] == $name)
                return true;
        }
        return false;
    }

    /**
     * 创建类
     * @param $name
     * @param $remark
     * @param int $sort
     * @return bool|null
     */
    private function createClass($name, $remark, $sort = 1)
    {
        $pData = array('name' => $name, 'system' => $this->system, 'sort' => $sort, 'remark' => $remark);
        $back = $this->runCall('auth-create-class', $pData);
        if ($back === false) {
            return false;
        }
        return $back;
    }


    /**
     * 批量创建权限方法
     * @param $funcs
     * @return bool|null
     */
    private function batchCreateFunc($funcs)
    {
        $pData = array('funcs' => $funcs);
        $back = $this->runCall('auth-batch-create-function', $pData);
        if ($back === false) {
            return false;
        }
        return $back;
    }

    /**
     * 获取展示菜单
     */
    public function getFuncMenu()
    {
        $pData = array('system' => $this->system, 'pid' => 0, 'level' => 4, 'sortStr' => array('sort' => 'asc'));
        $back = $this->runCall('auth-find-function-menu', $pData);
        if ($back === false) {
            return false;
        }
        return $back;
    }


    /**
     * 走接口调用数据
     * @param $urlKey
     * @param $params
     * @return bool|null
     */
    private function runCall($urlKey, $params)
    {
        $md = new BaseModel();
        $md->getResult($urlKey, $params);
        $err = $md->getError();
        $this->_err = $err;
        if (!empty($err))
            return false;
        return $md->_data;
    }
}