<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\newservices;

class NewWxPay extends BaseService
{

    public static $serviceProviderConfig = [
        'appId' => WEIXINAPPID,
        'appSecret' => WEIXINAPPSECRET,
        'mchId' => WEIXINMCHID,
        'key' => WEIXINMCHKEY
    ];

    public function __construct()
    {
        parent::__construct();
    }





}