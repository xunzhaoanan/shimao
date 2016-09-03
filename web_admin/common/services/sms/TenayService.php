<?php
/**
 * 短信的财付通支付
 * @author FoxxxZhu
 *
 */
namespace common\services\sms;

use yii\log\Logger;
class TenayService
{
    public function __construct()
    {
        require_once self::getWxpayApiBasePath().'classes'.DIRECTORY_SEPARATOR.'ResponseHandler.class.php';
        require_once self::getWxpayApiBasePath().'classes'.DIRECTORY_SEPARATOR.'RequestHandler.class.php';
        require_once self::getWxpayApiBasePath().'classes'.DIRECTORY_SEPARATOR.'client'.DIRECTORY_SEPARATOR.'ClientResponseHandler.class.php';
        require_once self::getWxpayApiBasePath().'classes'.DIRECTORY_SEPARATOR.'client'.DIRECTORY_SEPARATOR.'TenpayHttpClient.class.php';
        require_once self::getWxpayApiBasePath().'classes'.DIRECTORY_SEPARATOR.'function.php';
    }
    
    public function getNoticeInfo($is_debug = false)
    {
        $config = self::getConfig();
        /* 创建支付应答对象 */
        $resHandler = new \ResponseHandler();
        $resHandler->setKey($config['key']);

        $res = [
            'state' => 2,
            'order_no' => '',
            'tenpay_no' => '',
            'recharge_money' => 0,
        ];
        try{
        // 判断签名
        if ($resHandler->isTenpaySign() || $is_debug) {
            
            // 通知id
            $notify_id = $resHandler->getParameter("notify_id");
            
            // 通过通知ID查询，确保通知来至财付通
            // 创建查询请求
            $queryReq = new \RequestHandler();
            $queryReq->init();
            $queryReq->setKey($config['key']);
            $queryReq->setGateUrl("https://gw.tenpay.com/gateway/simpleverifynotifyid.xml");
            $queryReq->setParameter("partner", $config['partner']);
            $queryReq->setParameter("notify_id", $notify_id);
            
            $queryReq->setParameter("input_charset", "utf-8");
            
            // 通信对象
            $httpClient = new \TenpayHttpClient();
            $httpClient->setTimeOut(5);
            // 设置请求内容
            $httpClient->setReqContent($queryReq->getRequestURL());
            
            // 后台调用
            if ($httpClient->call()) {
                // 设置结果参数
                $queryRes = new \ClientResponseHandler();
                $queryRes->setContent($httpClient->getResContent());
                $queryRes->setKey($config['key']);
                
                if ($resHandler->getParameter("trade_mode") == "1") {
                    // 判断签名及结果（即时到帐）
                    // 只有签名正确,retcode为0，trade_state为0才是支付成功
                    if ($queryRes->isTenpaySign() &&
                             $queryRes->getParameter("retcode") == "0" &&
                             $resHandler->getParameter("trade_state") == "0") 
                    {
                        $res['state'] = 1;
                        //商户订单号
                        $res['order_no'] = $resHandler->getParameter("out_trade_no");
                        // 财付通订单号
                        $res['tenpay_no'] = $resHandler->getParameter("transaction_id");
                        
                        //充值金额
                        $res['recharge_money'] = intval($resHandler->getParameter("total_fee"));
                    } 
                    else 
                    {
                        self::debug("签名认证 或者 支付异常 账号异常",$queryRes->getAllParameters(),$resHandler->getAllParameters());
                        // 签名认证 或者 支付异常 账号异常
                        $res['state'] = 3;
                    }
                }
            } else {
                self::debug("通信失败");
                //通信失败
                $res['state'] = 4;
            }
        } else {
            //传入参数非法或者为伪造
            self::debug("传入参数非法或者为伪造");
            $res['state'] = 5;
        }
        }
        catch (\Exception $e)
        {
            self::debug("财付通支付回调错误 msg: ".$e->getMessage());
            \Yii::getLogger()->log("财付通支付回调错误! msg: ".$e->getMessage(), Logger::LEVEL_ERROR);
        }
        return $res;
    }
    
    public static function getWxpayApiBasePath()
    {
        return dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'Tenpay'.DIRECTORY_SEPARATOR;
    }
    
    
    public static function getConfig()
    {
        return [
            //财付通商户号
            'partner' => self::GetPartner(),        
            //财付通密钥                         	
            'key' => self::GetKey(),										
            //显示支付结果页面,*替换成payReturnUrl.php所在路径
            'return_url' => self::GetReturnUrl(),
            //支付完成后的回调处理页面,*替换成payNotifyUrl.php所在路径
            'notify_url' => self::GetNoticeUrl(),			
        ];
    }
    
    /**
     *
     * 生成扫描支付URL,模式一
     * @param BizPayUrlInput $bizUrlInfo
     */
    public function GetPrePayUrl($productId)
    {
        $biz = new \WxPayBizPayUrl();
        $biz->SetProduct_id($productId);
        $values = \WxpayApi::bizpayurl($biz);
        $url = "weixin://wxpay/bizpayurl?" . $this->ToUrlParams($values);
        return $url;
    }
    
    /**
     *
     * 参数数组转换为url参数
     * @param array $urlObj
     */
    private function ToUrlParams($urlObj)
    {
        $buff = "";
        foreach ($urlObj as $k => $v)
        {
            $buff .= $k . "=" . $v . "&";
        }
    
        $buff = trim($buff, "&");
        return $buff;
    }
    
    /**
     * 获取财付通商户号
     * @return Ambigous <string>
     */
	public static function GetPartner()
	{
	    $partner = [
    	    'local' => '1217092301',
    	    'dev' => '1217092301',
    	    'beta' => '1217092301',
    	    'online' => '1217092301',
	    ];
	    $env = CODE_RUNTIME;
	    if(isset($partner[$env]))
	    {
	        return $partner[$env];
	    }
	    return $partner['online'];
	}
	
	/**
	 * 
	 * @return Ambigous <string>
	 */
	public static function GetKey()
	{
	    $keys = [
	    'local' => '32df50758073284d2234b9090eed9bb9',
	    'dev' => '32df50758073284d2234b9090eed9bb9',
	    'beta' => '32df50758073284d2234b9090eed9bb9',
	    'online' => '32df50758073284d2234b9090eed9bb9',
	    ];
	    $env = CODE_RUNTIME;
	    if(isset($keys[$env]))
	    {
	        return $keys[$env];
	    }
	    return $keys['online'];
	}
    
    /**
     * 显示支付结果页面
     * @return Ambigous <成功时返回，其他抛异常, multitype:>
     */
    public static function GetReturnUrl()
    {
        $urls = [
            'local' => 'http://46.newwsh.vikduo.com/sms/recharge',
            'dev' => 'http://46.newwsh.vikduo.com/sms/recharge',
            'beta' => 'http://betanewwsh.vikduo.com/sms/recharge',
            'online' => 'http://wkd.gaopeng.com/sms/recharge',
        ];
        $env = CODE_RUNTIME;
        if(isset($urls[$env]))
        {
            return $urls[$env];
        }
        return $urls['online'];
    }
    
    /**
     * 支付回调页面
     * @return Ambigous <成功时返回，其他抛异常, multitype:>
     */
    public static function GetNoticeUrl()
    {
        $urls = [
        'local' => 'http://46.newwsh.vikduo.com/tenpay-callback/sms-order-notice',
        'dev' => 'http://46.newwsh.vikduo.com/tenpay-callback/sms-order-notice',
        'beta' => 'http://betanewwsh.vikduo.com/tenpay-callback/sms-order-notice',
        'online' => 'http://wkd.gaopeng.com/tenpay-callback/sms-order-notice',
        ];
        $env = CODE_RUNTIME;
        if(isset($urls[$env]))
        {
            return $urls[$env];
        }
        return $urls['online'];
    }
    
    public static function debug()
    {
        $info = func_get_args();
        $msg = json_encode($info,JSON_UNESCAPED_UNICODE);
        \Yii::getLogger()->log($msg, Logger::LEVEL_WARNING,'sms_tenpay');
//         $info = func_get_args();
//         echo json_encode($info,JSON_UNESCAPED_UNICODE);
//         echo "\n";
    }
}
