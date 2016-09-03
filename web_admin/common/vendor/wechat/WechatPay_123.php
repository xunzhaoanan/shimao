<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */

namespace common\vendor\wechat;

use common\vendor\wechat;
use Yii;
use yii\helpers\ArrayHelper;
use yii\base\Model;

class WechatPay
{
    public $appid ;
    public $appSecret ;
    public $account;
    public $paySDK ;

    public function __construct($option){
        $this->appid = isset($option['appid']) ? $option['appid'] : '';
        $this->appSecret = isset($option['secret']) ? $option['secret'] : '';
        $this->account = isset($option['account']) ? $option['account'] : '';
    }

    public function getPayInfo($payConfig,$orderInfo){
        // 获取prepay_id
        // 具体参数设置可以看文档http://pay.weixin.qq.com/wiki/doc/api/index.php?chapter=9_1
        //回调通知地址
        $notifyUrl = 'http://'.$_SERVER['HTTP_HOST'].'/'.$this->account.'/test/pay';
        $params = [
            'appid' => $this->appid,
            'appSecret' => $this->appSecret,
            'mchid' => $payConfig['account'],
            'key' => $payConfig['key'],
            'notify_url' => $notifyUrl
        ];
        //②、统一下单
        require_once("wxpay_skd/lib/WxPay.Data.php");
        $input = new \WxPayUnifiedOrder();
        $input->SetBody("test");
        $input->SetAttach("test");
        $input->SetOut_trade_no($params['mchid'].date("YmdHis"));
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url($notifyUrl);
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($orderInfo['open_id']);
        require_once('wxpay_skd/lib/WxPay.Api.php');
        $pay = new \WxPayApi($params);
        $pay->unifiedOrder($input);


    }

} 