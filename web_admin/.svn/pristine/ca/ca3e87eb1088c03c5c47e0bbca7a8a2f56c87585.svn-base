<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/17
 * Time: 14:19
 */

namespace common\vendor\upload\cdn;

class CDN {

    const CND_REQUEST_URL = 'http://imgcache.vikduo.com';

    public static $cdnData = null ;

    /**
     * @param 上传图片到cdn
     * 内部调用
     */
    private static function _transfer($fileStream , $fileName , $fileType) {
        //CDN接口有的文件名中带空格会上传失败
        $fileName = str_replace(" ", "", $fileName);
        $url = self::CND_REQUEST_URL . '?file_name=' . $fileName . '&file_type=' . $fileType;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fileStream);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        //curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0); //强制协议为1.0
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Expect:")); //头部要送出'Expect: '
        //curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4); //强制使用IPV4协议解析域名
        $sContent = curl_exec($ch);
        $aStatus = curl_getinfo($ch);
        curl_close($ch);
        if(intval($aStatus["http_code"])==200){
            self::$cdnData = $sContent;
        }
    }

    /**
     * @param 上传文件
     * 内部调用
     */
    public static function uploadFile($filePath , $fileName , $fileType ) {
        return self::_transfer(file_get_contents($filePath), $fileName, $fileType);
    }

    /**
     * @param 文件流上传文件
     * 内部调用
     */
    public static function uploadFileRaw($stream = null, $fileName = null, $fileType = null) {
        return self::_transfer($stream, $fileName, $fileType);
    }

}

