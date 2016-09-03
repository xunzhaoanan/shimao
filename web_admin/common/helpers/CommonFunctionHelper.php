<?php
/**
 * Author: MaChenghang
 * Date: 2015/10/22
 * Time: 22:08
 */

namespace common\helpers;
use Yii;

class CommonFunctionHelper
{

    /**
     * 	作用：格式化参数，签名过程需要使用
     */
    public static function formatBizQueryParaMap($paraMap, $urlencode)
    {
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v)
        {
            if($urlencode)
            {
                $v = urlencode($v);
            }
            //$buff .= strtolower($k) . "=" . $v . "&";
            $buff .= $k . "=" . $v . "&";
        }
        $reqPar;
        if (strlen($buff) > 0)
        {
            $reqPar = substr($buff, 0, strlen($buff)-1);
        }
        return $reqPar;
    }

    /**
     * 	作用：生成签名
     */
    public static function getSign($Obj,$key)
    {
        foreach ($Obj as $k => $v)
        {
            $Parameters[$k] = $v;
        }
        //签名步骤一：按字典序排序参数
        ksort($Parameters);
        $String = self::formatBizQueryParaMap($Parameters, false);
        //echo '【string1】'.$String.'</br>';
        //签名步骤二：在string后加入KEY
        $String = $String."&key=".$key;
        //echo "【string2】".$String."</br>";
        //签名步骤三：MD5加密
        $String = md5($String);
        //echo "【string3】 ".$String."</br>";
        //签名步骤四：所有字符转为大写
        $result_ = strtoupper($String);
        //echo "【result】 ".$result_."</br>";
        return $result_;
    }

    /**
     * 	作用：array转xml
     */
    public static function arrayToXml($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key=>$val)
        {
            if (is_numeric($val))
            {
                $xml.="<".$key.">".$val."</".$key.">";
            }
            else
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
        }
        $xml.="</xml>";
        return $xml;
    }

    /**
     * 获取当前请求url
     */
    public static function getUrl(){
        return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    /**
     * 跳转url
     */
    public static function redirect($url = '/')
    {
        if (is_array($url)) {
            $url = $url[0];
        }
        Header('Location: ' . $url);
        exit;
    }

    /**
     * 是否为 非空数组
     */
    public static function isArrayCount($array)
    {
        if( ! is_array($array)){
            return false;
        }
        if( ! count($array)){
            return false;
        }
        return true;
    }

    /**
     * 数组的key是否存在
     * 1、是否存在某个key
     * 2、存在某个key且值 为真
     * 3、存在某个key且值 不是null
     * 4、存在某个key且值 为非空数组
     * 5、存在某个key且值 不是空字符串
     */
    public static function arrayKeyExists($array,$key,$type = 3){
        if( ! is_array($array)){
            return false;
        }
        if( ! count($array)){
            return false;
        }
        if( ! array_key_exists($key,$array)){
            return false;
        }
        switch($type){
            case 1 :
                return true;
                break;
            case 2 :
                if( $array[$key] ){
                    return true;
                }else{
                    return false;
                }
                break;
            case 3 :
                if( is_null($array[$key]) ){
                    return false;
                }else{
                    return true;
                }
                break;
            case 4 :
                if( is_array($array[$key]) && count($array[$key])){
                    return true;
                }else{
                    return false;
                }
                break;
            case 5 :
                if( $array[$key] !== ''){
                    return false;
                }else{
                    return true;
                }
                break;
        }
        return false;
    }

    /**
     * 得到请求来源链接
     */
    public static function getRefererUrl()
    {
        if (self::arrayKeyExists($_SERVER,'HTTP_REFERER')) {
            return $_SERVER['HTTP_REFERER'];
        }else{
            return null;
        }
    }


    /**
     * 去除数组特定值
     * chat 代表需要去除的值，字符串类型
     * chat 可以是 null 、false 、'' 、 0 、等一切特殊数据类型或字符串
     */
    public static function filterArrayValue($arr,$chat)
    {
        self::_filterArrayValue($arr,$chat);
        return $arr;
    }

    /**
     * 数组去除指定值
     * keys 是个数组
     * 不对外调用
     */
    private static function _filterArrayValue(&$arr,$chat)
    {
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                self::_filterArrayValue($arr[$key],$chat);
            } elseif ($val === $chat) {
                unset($arr[$key]);
            }
        }
    }

    /**
     * 数组去除指定 key
     * keys 是个数组
     */
    public static function unsetArrayKeys($arr,$keys)
    {
        self::_unsetArrayKeys($arr,$keys);
        return $arr;
    }

    /**
     * 数组去除指定 key
     * keys 是个数组
     * 不对外调用
     */
    private static function _unsetArrayKeys(&$arr,$keys)
    {
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                self::_unsetArrayKeys($arr[$key],$keys);
            } else{
                if (in_array($key,$keys)) {
                    unset($arr[$key]);
                }
            }
        }
    }

    /**
     * 数组只保留指定的 key
     * keys 是个数组
     */
    public static function retainArrayKeys($arr,$keys){
        self::_retainArrayKeys($arr,$keys);
        return $arr;
    }

    /**
     * 数组保留指定 key
     * keys 是个数组
     * 不对外调用
     */
    private static function _retainArrayKeys(&$arr,$keys){
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                self::_retainArrayKeys($arr[$key],$keys);
            } else{
                if ( ! in_array($key,$keys)) {
                    unset($arr[$key]);
                }
            }
        }
    }

    /**
     * 数组替换键 key
     * keys 是个数组
     */
    public static function replaceArrayKeys($arr,$keys){
        self::_replaceArrayKeys($arr,$keys);
        return $arr;
    }

    /**
     * 数组替换 key
     * keys 是个数组
     * 不对外调用
     */
    private static function _replaceArrayKeys(&$arr,$keys){
        if (is_array($arr) && count($arr)) {
            $newArr = array();
            foreach ($arr as $key => $val) {
                if (array_key_exists($key, $keys)) {
                    $newArr[$keys[$key]] = $val;
                } else {
                    $newArr[$key] = $val;
                }
            }
            $arr = $newArr;
        }
    }

    /**
     * 获取ip
     */
    public static function getIp()
    {
        if (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } else if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('REMOTE_ADDR')) {
            $ip = getenv('REMOTE_ADDR');
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $ips = explode(',', $ip);
        if (count($ips) > 1) {
            $ip = $ips[0];
        }
        return $ip;
    }

    /**
     * 获取客户端浏览器
     */
    public static function getBrowse(){
        if ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
            $userAgent = strtolower( $_SERVER['HTTP_USER_AGENT'] ) ;
        } else {
            $userAgent = 'unknown' ;
        }
        $browser = 'other';
        if (preg_match('/MSIE/i',$userAgent)) {
            $browser = 'ie';
        }else if(preg_match('/Firefox/i',$userAgent)){
            $browser = 'Firefox';
        }else if (preg_match('/Chrome/i',$userAgent)){
            $browser = 'chrome';
        }else if (preg_match('/Safari/i',$userAgent)){
            $browser = 'safari';
        }else if (preg_match('/Opera/i',$userAgent)){
            $browser = 'opera';
        }
        return $browser;
    }

    /**
     * 获取客户端代理信息
     */
    public static function getUserAgent(){
        if ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
            $userAgent = strtolower( $_SERVER['HTTP_USER_AGENT'] ) ;
        } else {
            $userAgent = 'unknown' ;
        }
        return $userAgent;
    }

    /**
     * 获取客户端访问操作系统
     */
    public static function getOs(){
        if ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
            $userAgent = strtolower( $_SERVER['HTTP_USER_AGENT'] ) ;
        } else {
            $userAgent = 'unknown' ;
        }

        $os = 'web';
        if(preg_match('/iphone/i',$userAgent)){
            $os = 'iphone';
        }else if(preg_match('/android/i',$userAgent)){
            $os = 'android';
        }else if(preg_match('/ipad/i',$userAgent)){
            $os = 'ipad';
        }else if(preg_match('/win/i',$userAgent)){
            $os = 'windows';
        }else if(preg_match('/mac/i',$userAgent)){
            $os = 'mac';
        }else if(preg_match('/linux/i',$userAgent)){
            $os = 'linux';
        }else if(preg_match('/unix/i',$userAgent)){
            $os = 'unix';
        }else if(preg_match('/bsd/i',$userAgent)){
            $os = 'bsd';
        }
        return $os;
    }

    /**
     * 获取客户端访问设备
     */
    public static function getDevice(){
        if ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
            $userAgent = strtolower( $_SERVER['HTTP_USER_AGENT'] ) ;
        } else {
            $userAgent = 'unknown' ;
        }
        $device = 'pc';
        if(preg_match('/iphone/i',$userAgent)){
            $device = 'phone';
        }else if(preg_match('/android/i',$userAgent)){
            $device = 'phone';
        }else if(preg_match('/ipad/i',$userAgent)){
            $device = 'pad';
        }else if(preg_match('/win/i',$userAgent)){
            $device = 'pc';
        }else if(preg_match('/mac/i',$userAgent)){
            $device = 'pc';
        }else if(preg_match('/linux/i',$userAgent)){
            $device = 'pc';
        }else if(preg_match('/unix/i',$userAgent)){
            $device = 'pc';
        }else if(preg_match('/bsd/i',$userAgent)){
            $device = 'pc';
        }
        return $device;
    }

}