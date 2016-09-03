<?php
/**
 * Author: xuxq
 * Date: 2015/11/24
 * Time: 14:32
 */

namespace common\helpers;


class TcApi
{

//    const URL= 'http://betatc.vikduo.com/interface/do.php';
    const URL= 'http://tc.local.com/interface/do.php';//10.20.50.183  tc.local.com
    const USERNAME= 'wsh';
    const PASSWORD= '10e565261c1d7b91a69c555264a328ae';
    const SKEY= '9efee7643e28bc8729156734a9ad21d2';

    public $who;

    /**
     * 上传证书
     * @param string $kind
     * @param array $arr 上传参数，
     * @return mixed $result
     */
    public function uploadCertificate($kind,$arr)
    {
        $this->who='pem';
        $code = '';
        if ($kind==2)
            $code = 'wx_pem_upload';
        else if ($kind==3)
            $code = 'cft_pem_upload';
        $results = $this->_http($code,$arr);
        return $results;
    }

    /**
     * @param $requestcode
     * @param $requestbody
     * @return mixed
     */
    private function _http($requestcode,$requestbody)
    {
        $requestbody = $this->_encodeBody($requestbody);

        $results = $this->curl_post(TcApi::URL,array(
            'who'=>$this->who,
            'username'=>TcApi::USERNAME,
            'password'=>TcApi::PASSWORD,
            'requestcode'=>$requestcode,
            'requestbody'=>$requestbody,
            'timer'=>$this->_getTime(),
            'hash'=> $this->_getHash($requestcode,$requestbody),
            'debug'=>0
        ));
        //VarDumper::dump('boss:result:'.$results,1,1);exit;
        return $results;
    }

    /**
     * @param $requestcode
     * @param $requestbody
     * @return string
     */
    private function _getHash($requestcode,$requestbody)
    {
        $hash =  substr(strtoupper( md5( $this->who.TcApi::USERNAME.TcApi::PASSWORD.$requestcode.$requestbody.$this->_getTime().TcApi::SKEY ) ),0,10);
        return $hash;
    }

    /**
     * @param $requestbody
     * @return string
     */
    private function _encodeBody($requestbody)
    {
        $requestbody = base64_encode( json_encode($requestbody));
        return $requestbody;
    }

    private $_timer = null;
    private function _getTime(){
        if ($this->_timer===null)
            $this->_timer = time();
        return $this->_timer;
    }

    /* curl连接 */
    function data_encode($data, $keyprefix = "", $keypostfix = "") {

        assert( is_array($data) );
        $vars=null;
        foreach($data as $key=>$value) {
            if(is_array($value))
                $vars .=  $this->data_encode($value, $keyprefix.$key.$keypostfix.urlencode("["), urlencode("]"));
            else
                $vars .= $keyprefix.$key.$keypostfix."=".urlencode($value)."&";
        }

        return $vars;
    }


    public function curl_post($url='',$postfields=array(),$method='post',$timeout=60){
        $ch = @curl_init();
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, intval($timeout) ); //超时时间
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //以字符串输出结果
        $paramStr = substr( $this->data_encode($postfields), 0, -1);
        if($method == 'post'){
            curl_setopt($ch, CURLOPT_POST, 1);       //POST方式
            curl_setopt($ch, CURLOPT_POSTFIELDS, $paramStr);//POST数据
            curl_setopt($ch, CURLOPT_URL, $url);//提交地址
        }else{
            # get方式
            curl_setopt($ch, CURLOPT_URL, $url.'?'.$paramStr);//提交地址
        }
        $back = @curl_exec($ch);
        $msg = $url.'--'.$paramStr.'   ####'.$back;//日志
        \Yii::info($msg,'Tc_Api');
        return $back;
    }

}