<?php
/**
 * 微信公众平台授权相关
 * Author: MaChenghang
 * Date: 2015/06/20
 * Time: 11:47
 */

namespace common\vendor\wechat;

use common\vendor\wechat\wechat_sdk\Wechat;

class WechatQrcode
{

    protected $wechatSDK ;

    function __construct($options){
        $this->wechatSDK = new Wechat($options);
    }

    /**
     * 创建二维码ticket
     * @param int|string $scene_id 自定义追踪id,临时二维码只能用数值型
     * @param int $type 0:临时二维码；1:永久二维码(此时expire参数无效)；2:永久的字符串参数值二维码(此时expire参数无效)
     * @param int $expire 临时二维码有效期，最大为1800秒
     * @return array('ticket'=>'qrcode字串','expire_seconds'=>1800,'url'=>'二维码图片解析后的地址')
     */
    public function getQRCode($params){
        $params['expire'] = 604800;
        return $this->wechatSDK->getQRCode($params['scene_id'],$params['qrcode_type'],$params['expire']);
    }

    /**
     * 通过ticket换取二维码
     * @param string $ticket 传入由getQRCode方法生成的ticket参数
     * @return string url 返回http地址
     */
    public function getQRUrl($ticket) {
        return $this->wechatSDK->getQRUrl($ticket);
    }

    /**
     * 长链接转短链接
     * @param string $long_url 传入要转换的长url
     * @return boolean|string url 成功则返回转换后的短url
     */
    public function getShortUrl($long_url){
        return $this->wechatSDK->getShortUrl($long_url);
    }


}
