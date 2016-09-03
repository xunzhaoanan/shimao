<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\models;

use common\cache\BaseCache;
use common\helpers\BaseApiHelper;
use Yii;
use yii\base\Model;

class BaseModel extends Model
{

    /**
     * 启用状态值
     */
    const STATUS_ENABLE = 1;

    /**
     * 禁用状态值
     */
    const STATUS_DISABLE = 2;

    /**
     * 删除状态值
     */
    const STATUS_DELETE = 3;

    private $errorMsg = null;
    // 结果集
    public $_data = null;

    /**
     * 获取数据
     */
    public function getResult($urlKey, $params , $filter = true)
    {
        $this->_data = null;
        $this->errorMsg = null;
        if($filter) self::filterNullValue($params);
        $apiData = BaseApiHelper::sync_test($urlKey,$params);
        if (substr($apiData, 0, 3) == pack("CCC", 0xEF, 0xBB, 0xBF)) {
            $apiData = substr($apiData, 3);
        }
        $data = json_decode($apiData, true);
        if (isset($data['errmsg']) && isset($data['errcode'])) {
            if ($data['errcode'] == 0 && $data['errmsg'] == 'ok') {
                unset($data['errcode']);
                unset($data['errmsg']);
                if (isset($data['page'])) {
                    $this->_data = $data;
                } else {
                    if (is_array($data['data']) && count($data['data'])) {
                        $this->_data = $data['data'];
                    } else if (!is_null($data['data'])) {
                        $this->_data = $data['data'];
                    }
                }
            } else {
                if (isset($data['data'])) {
                    $this->setError([
                        'errcode' => $data['errcode'],
                        'errmsg' => $data['data']
                    ]);
                } else {
                    $this->setError($data);
                }
            }
        } else {
            if (isset($data['data'])) {
                $this->setError([
                    'errcode' => $data['errcode'],
                    'errmsg' => $data['data']
                ]);
            } else {
                $this->setError();
            }
        }
    }

    /**
     * post数据
     */
    public function postDataOnly($urlKey, $params)
    {
        self::filterNullValue($params);
        BaseApiHelper::async($urlKey,$params);
    }

    /**
     * 直接传输post数据
     */
    public function transferDataOnly($url, $params)
    {
        self::filterNullValue($params);
        BaseCache::append('test_cache', time().'start');
        $this->_ajaxHttp($url, json_encode($params, true));
        BaseCache::append('test_cache', time().'end');
    }

    /**
     * 把金额由元转为分
     */
    public static function amountToFen($amount){
        $amount = $amount * 100;
        if(strpos($amount, '.') !== false){
            return ceil($amount);
        }
        return $amount;
    }

    /**
     * 把金额由分转为元
     */
    public static function amountToYuan($amount, $transToNull = false)
    {
        //是否转换
        if($transToNull && (is_null($amount) || empty($amount))) return null;
        if(is_null($amount) || empty($amount)) return 0.00;
        $amount /= 100;
        $strpos = strpos($amount, '.');
        if ($strpos !== false) {
            if (strlen($amount) - $strpos != 3) {
                return $amount . '0';
            }
            return $amount;
        } else {
            return $amount . '.00';
        }
    }

    /**
     * 设置或格式化结果集
     */
    public function setResult($data)
    {
        $this->errorMsg = null;
        $this->_data = $data;
    }

    /**
     * 设置数据层错误信息
     */
    public function setError($params = array())
    {
        $this->errorMsg = [
            'errcode' => isset($params['errcode']) ? $params['errcode'] : -3,
            'errmsg' => isset($params['errmsg']) ? $params['errmsg'] : '服务器忙，请稍后再尝试'
        ];
    }

    /**
     * 得到数据层错误信息
     */
    public function getError()
    {
        return $this->errorMsg;
    }

    /**
     * 过滤掉null值的参数
     * @return array
     */
    private static function filterNullValue(&$params)
    {
        if (is_array($params)) {
            foreach ($params as $key => $val) {
                if (is_array($val)) {
                    self::filterNullValue($params[$key]);
                } else if (is_null($val) || $val === '') {
                    unset($params[$key]);
                }
            }
        }
    }

    /**
     * post获取接口数据
     */
    protected function postCurl($url, $params , $filter = true)
    {
        if($filter) self::filterNullValue($params);
        return $this->http_post($url, json_encode($params, true));
    }

    /**
     * 字符串转义
     * @param $form
     */
    function addslash($val, $force = false)
    {
        if (!get_magic_quotes_gpc() || $force) {
            if (is_array($val)) {
                foreach ($val as $key => $value) {
                    if (is_array($value)) {
                        $val[$key] = self::addslash($value, $force);
                    } else {
                        $val[$key] = addslashes($value);
                    }
                }
            } else {
                $val = addslashes($val);
            }
        }
        return $val;
    }


    /**
     * POST 请求
     * @param string $url
     * @param array $param
     * @param boolean $post_file 是否文件上传
     * @return string content
     */
    private function http_post($url, $param, $post_file = false)
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        if (is_string($param) || $post_file) {
            $strPOST = $param;
        } else {
            $aPOST = array();
            foreach ($param as $key => $val) {
                $aPOST[] = $key . "=" . urlencode($val);
            }
            $strPOST = join("&", $aPOST);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POST, true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        BaseCache::append('test_cache', __FILE__ . '_____' . __LINE__, 1800, true);
        BaseCache::append('test_cache', $url, 1800, true);
        BaseCache::append('test_cache', $param, 1800, true);
        BaseCache::append('test_cache', $sContent, 1800, true);
        if (intval($aStatus["http_code"]) == 200) {
            return $sContent;
        } else {
            return '{"errcode":-3,"errmsg":"服务器接口忙，请稍后再试"}';
        }
    }

    /**
     * 转发请求
     * @param $url
     * @param $param
     */
    private function _ajaxHttp($url, $param)
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        if (is_string($param)) {
            $strPOST = $param;
        } else {
            $aPOST = array();
            foreach ($param as $key => $val) {
                $aPOST[] = $key . "=" . urlencode($val);
            }
            $strPOST = join("&", $aPOST);
        }
        curl_setopt($oCurl, CURLOPT_NOSIGNAL, 1);
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_TIMEOUT_MS, 50);//超时为50毫秒
        curl_setopt($oCurl, CURLOPT_POST, true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
        curl_exec($oCurl);
        curl_close($oCurl);
    }

    /**
     * 获取分页参数
     * @return array
     */
    public function getPageParams()
    {
        $page = Yii::$app->request->get('_page');
        $page = (int)$page - 1; //接口分页从0开始
        if ($page < 0) $page = 0;
        $pageSize = Yii::$app->request->get('_page_size');
        $pageSize = (int)$pageSize;
        if ($pageSize <= 0) $pageSize = 20; // 默认一页条数
        return [
            'page' => $page,
            'page_size' => $pageSize
        ];
    }

    /**
     * 格式化页码信息
     * @param $page array 分页信息
     * @return mixed
     */
    public function pageInfo($page)
    {
        return [
            'page' => $page['current_page'] + 1,
            'count' => $page['total_count'],
            'page_size' => $page['per_page'],
            'page_count' => $page['total_page'],
        ];
    }

} 