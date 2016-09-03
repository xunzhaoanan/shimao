<?php
/**
 * Author: MaChenghang
 * Date: 2015/10/22
 * Time: 22:08
 */
namespace common\newservices;

use common\helpers\BaseApiHelper;
use common\helpers\CommonFunctionHelper;
use common\helpers\JsApiCodeHelper;
use common\helpers\JsApiHelper;
use Yii;

class BaseService
{

    private $_errCode;
    private $_errMsg;

    public function __construct(){
        $this->_errCode = null;
        $this->_errCode = null;
    }

    /**
     * 获取错误信息
     */
    public function getError(){
        if(is_null($this->_errCode)){
            return false;
        }
        return [
            'errCode' => $this->_errCode,
            'errMsg' => $this->_errMsg
        ];
    }

    /**
     * 设置错误信息
     */
    public function setError($errMsg,$errCode = null,$killThread = true){
        if(! $errCode){
            $errCode = JsApiCodeHelper::CODE_ERROR_SERVICE;
        }
        if($killThread){
            JsApiHelper::setError($errMsg,$errCode);
        }
        $this->_errCode = $errCode;
        $this->_errMsg = $errMsg;
    }

    /**
     * 格式化数据
     *
    $data = [
    'id' => 123,
    'documentLib' => [
    'name' => 'asc',
    'shareMessage' => [
    [
    'id' => '好好好',
    'name' => '你你你',
    ],
    [
    'id' => '好好好',
    'name' => '你你你',
    ],
    ]
    ]
    ];
    $keyMap = [
    'id' => 'id',
    'documentLib->name' => 'name',
    'documentLib->shareMessage' => 'shareMessage',
    'documentLib->shareMessage->_hasManyData->name' => 'desc',
    ];
    $this->handleData($data,$keyMap);
     */
    public function handleData($data,$keyMap,$splitChat = '->'){
        $newData = [];
        foreach($keyMap as $key=>$val){
            if(is_array($val)){
                $newData[$key] = $this->handleData($data,$val,$splitChat);
            }else{
                $newData[$key] = $this->getHasOneData($data,$val,$splitChat);
            }
        }
        return $newData;
    }

    /**
     * 格式化单条数据
     */
    public function getHasOneData($data,$keyMap,$splitChat){
        $newData = '';
        if(count($explode = explode($splitChat,$keyMap)) > 1){
            $tmpData = $data;
            foreach($explode as $explodeKey=>$explodeVal){
                if(CommonFunctionHelper::arrayKeyExists($tmpData,$explodeVal)){
                    $tmpData = $tmpData[$explodeVal];
                    unset($explode[$explodeKey]);
                }else{
                    if($explodeVal == '_hasManyData'){
                        unset($explode[$explodeKey]);
                        $tmpData = $this->getHasManyData($tmpData,implode($splitChat,$explode),$splitChat);
                    }
                }
                $newData = $tmpData;
            }
        }else{
            if(CommonFunctionHelper::arrayKeyExists($data,$keyMap)){
                $newData = $data[$keyMap];
            }
        }

        return $newData;
    }

    /**
     * 格式化多条数据
     */
    private function getHasManyData($data,$explodeValue,$splitChat){
        $newData = [];
        foreach ($data as $key=>$val) {
            $newData[] = $this->getHasOneData($val,$explodeValue,$splitChat);
        }
        return $newData;
    }

    /**
     * 获取数据
     */
    public function getResult($urlKey, $params,$killThread = true)
    {
        $result = BaseApiHelper::sync($urlKey,$params);
        if (substr($result, 0, 3) == pack("CCC", 0xEF, 0xBB, 0xBF)) {
            $result = substr($result, 3);
        }
        $data = json_decode($result, true);
        if (isset($data['errmsg']) && isset($data['errcode'])) {
            if ($data['errcode'] == 0 && $data['errmsg'] == 'ok') {
                unset($data['errcode']);
                unset($data['errmsg']);
                if (isset($data['page'])) {
                    return $data;
                } else {
                    if (is_array($data['data']) && count($data['data'])) {
                        return $data['data'];
                    } else if (!is_null($data['data'])) {
                        return $data['data'];
                    }
                }
            } else {
                if (isset($data['errmsg'])) {
                    $this->setError($data['errmsg'],$data['errcode'],$killThread);
                } else {
                    $this->setError('服务器忙，请稍后再试','',$killThread);
                }
            }
        } else {
            if (isset($data['errmsg'])) {
                $this->setError($data['errmsg'],'',$killThread);
            } else {
                $this->setError('服务器忙，请稍后再试','',$killThread);
            }
        }
        return false;
    }

    /**
     * 异步请求，不需要返回数据
     */
    public function postData($urlKey, $params)
    {
        BaseApiHelper::async($urlKey,$params);
    }

} 