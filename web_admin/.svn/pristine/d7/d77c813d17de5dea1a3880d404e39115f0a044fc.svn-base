<?php
/**
 * 微信公众平台微信门店
 * Author: MaChenghang
 * Date: 2015/06/20
 * Time: 11:47
 */

namespace common\vendor\wechat;

use common\vendor\wechat\wechat_sdk\Wechat;

class WechatStore
{

    protected $wechatSDK ;

    function __construct($options){
        $this->wechatSDK = new Wechat($options);
    }


    /**
     * 拉取门店列表
     * 获取在公众平台上申请创建的门店列表
     * @param int $offset  开始拉取的偏移，默认为0从头开始
     * @param int $count   拉取的数量，默认为0拉取全部
     * @return boolean|array   返回数组请参看 微信卡券接口文档 的json格式
     */
    public function getCardLocations($offset=0,$count=0) {
        return $this->wechatSDK->getCardLocations($offset,$count);
    }

    /**
     * 批量导入门店信息
     * @tutorial 返回插入的门店id列表，以逗号分隔。如果有插入失败的，则为-1，请自行核查是哪个插入失败
     * @param array $data    数组形式的json数据，由于内容较多，具体内容格式请查看 微信卡券接口文档
     * @return boolean|string 成功返回插入的门店id列表
     */
    public function addCardLocations($data) {
        return $this->wechatSDK->addCardLocations($data);
    }


}
