<?php
namespace common\vendor\wechat\wxpay;

use Yii;
use common\vendor\wechat\wxpay\CommonUtilPub;

/**
 * 响应型接口基类
 */
class WxpayServerPub extends CommonUtilPub
{
	public $data;//接收到的数据，类型为关联数组
	var $returnParameters;//返回参数，类型为关联数组
	
	/**
	 * 将微信的请求xml转换成关联数组，以方便数据处理
	 */
	function saveData($xml)
	{
		$this->data = $this->xmlToArray($xml);
	}
	
	function checkSign()
	{
		$tmpData = $this->data;
		unset($tmpData['sign']);
		$sign = $this->getSign($tmpData);//本地签名
		if ($this->data['sign'] == $sign) {
			return TRUE;
		}
		return FALSE;
	}
	
	/**
	 * 获取微信的请求数据
	 */
	function getData()
	{		
		return $this->data;
	}
	
	/**
	 * 设置返回微信的xml数据
	 */
	function setReturnParameter($parameter, $parameterValue)
	{
		$this->returnParameters[$this->trimString($parameter)] = $this->trimString($parameterValue);
	}
	
	/**
	 * 生成接口参数xml
	 */
	function createXml()
	{
		return $this->arrayToXml($this->returnParameters);
	}
	
	/**
	 * 将xml数据返回微信
	 */
	function returnXml()
	{
		$returnXml = $this->createXml();
		return $returnXml;
	}

    /**
     * 订单查询
     * @param $data array
     *
     * @return mixed
     */
    function orderQuery($data)
    {
        $data['transaction_id']; //微信订单号
        $data['out_trade_no']; //商户订单号

        $url = 'https://api.mch.weixin.qq.com/pay/orderquery';
        $data['appid'] = $this->appId;
        $data['mch_id'] = $this->mchId;
        $data['nonce_str'] = $this->createNoncestr(); //随机字符串
        $data['sign'] = $this->getSign($data);
        $postXml = $this->arrayToXml($data);

        $returnXml = $this->postXmlCurl($postXml, $url);
        return $this->xmlToArray($returnXml);
    }

    /**
     * 订单关闭
     * @param $data array
     * @return mixed
     */
    function orderClose($data)
    {
        $data['out_trade_no']; //商户订单号

        $url = 'https://api.mch.weixin.qq.com/pay/closeorder';
        $data['appid'] = $this->appId;
        $data['mch_id'] = $this->mchId;
        $data['nonce_str'] = $this->createNoncestr(); //随机字符串
        $data['sign'] = $this->getSign($data);
        $postXml = $this->arrayToXml($data);

        $returnXml = $this->postXmlCurl($postXml, $url);
        return $this->xmlToArray($returnXml);
    }

    /**
     * 申请退款
     *                          请求需要双向证书
     * @param $data array
     * @return mixed
     */
    function payRefund($data)
    {
        $data['transaction_id']; //微信订单号
        $data['out_trade_no']; //商户订单号
        $data['out_refund_no']; //商户退款单号
        $data['total_fee']; //总金额
        $data['refund_fee']; //退款金额

        //非必填项
        //$data['device_info']; //设备号
        //$data['refund_fee_type']; //货币种类

        $url = 'https://api.mch.weixin.qq.com/secapi/pay/refund';
        $data['appid'] = $this->appId;
        $data['mch_id'] = $this->mchId;
        $data['op_user_id'] = $this->mchId; //操作员
        $data['nonce_str'] = $this->createNoncestr(); //随机字符串
        $data['sign'] = $this->getSign($data);
        $postXml = $this->arrayToXml($data);
//        die($postXml);

        $returnXml = $this->postXmlCurl($postXml, $url);
        return $this->xmlToArray($returnXml);
    }
}

