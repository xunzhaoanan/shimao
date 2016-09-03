<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/17
 * Time: 14:19
 */

namespace common\vendor\document;

class DocumentLib {

    # 文件格式
    const TYPE_IMAGE = 1 ;
    const TYPE_VOICE = 2 ;
    const TYPE_MUSIC = 2 ;
    const TYPE_VIDEO = 4 ;
    const TYPE_WORD = 5 ;
    const TYPE_EXCEL = 6 ;
    const TYPE_NARROW = 7 ;

    // 文件类型
    public static $fileType = null;

    // 文件格式
    public static $fileFormat = null;

    public static $fileName = null;

    /**
     * 获取指定文件格式的文件类型
     * 如果$format有指定值，则必须是  图片、语音、音乐、视频 其中的一个
     * @return mixed
     */
    public static function getFileType($filePath,$fileName = '',$format = false){
        if( empty($fileName)){
            self::$fileName = $filePath;
        }else{
            self::$fileName = $fileName;
        }
        $fileStream = self::_getFileStream($filePath);
        if($fileStream === false) {
            return false;
        }
        if($format !== false){
            switch($format){
                case self::TYPE_IMAGE :
                    self::_getImageType($fileStream);
                    break;
                case self::TYPE_VOICE :
                    self::_getVoiceType($fileStream);
                    break;
                case self::TYPE_MUSIC :
                    self::_getVideoType($fileStream);
                    break;
                case self::TYPE_VIDEO :
                    self::_getVideoType($fileStream);
                    break;
            }
        }else{
            self::_getAllType($fileStream);
        }
    }

    /**
     * 获取全部格式的文件类型
     * @return mixed
     */
    private static function _getAllType($fileStream)
    {
        $typeCode = intval($fileStream['chars1'] . $fileStream['chars2']);

        switch ($typeCode) {
            case 255216:
                self::$fileType = 'jpg';
                self::$fileFormat = self::TYPE_IMAGE;
                break;
            case 7173:
                self::$fileType = 'gif';
                self::$fileFormat = self::TYPE_IMAGE;
                break;
            case 6677:
                self::$fileType = 'bmp';
                self::$fileFormat = self::TYPE_IMAGE;
                break;
            case 13780:
                self::$fileType = 'png';
                self::$fileFormat = self::TYPE_IMAGE;
                break;
        }
        if ($fileStream['chars1']=='-1' && $fileStream['chars2']=='-40' ) {
            self::$fileType = 'jpg';
            self::$fileFormat = self::TYPE_IMAGE;
        }
        if ($fileStream['chars1']=='-119' && $fileStream['chars2']=='80' ) {
            self::$fileType = 'png';
            self::$fileFormat = self::TYPE_IMAGE;
        }
        //如果没拿到就先用后缀检验文件类型
        if(is_null(self::$fileType)){
            $type = explode('.',self::$fileName);
            if(count($type) < 2){
                return false;
            }
            $fileType = strtolower(end($type));
            switch($fileType){
                case 'mp3' :
                    self::$fileType = 'mp3';
                    self::$fileFormat = self::TYPE_VOICE;
                    break;
                case 'wav' :
                    self::$fileType = 'wav';
                    self::$fileFormat = self::TYPE_VOICE;
                    break;
                case 'wma' :
                    self::$fileType = 'wma';
                    self::$fileFormat = self::TYPE_VOICE;
                    break;
            }
        }

    }


    /**
     * 获取图片格式的文件类型
     * @return mixed
     */
    private static function _getImageType($fileStream){
        self::$fileFormat = self::TYPE_IMAGE;
        $typeCode = intval($fileStream['chars1'].$fileStream['chars2']);
        switch ($typeCode)
        {
            case 255216:
                self::$fileType = 'jpg';
                break;
            case 7173:
                self::$fileType = 'gif';
                break;
            case 6677:
                self::$fileType = 'bmp';
                break;
            case 13780:
                self::$fileType = 'png';
                break;
        }
        if ($fileStream['chars1']=='-1' && $fileStream['chars2']=='-40' ) {
            self::$fileType = 'jpg';
        }
        if ($fileStream['chars1']=='-119' && $fileStream['chars2']=='80' ) {
            self::$fileType = 'png';
        }
    }

    /**
     * 获取语音格式的文件类型
     * @return mixed
     */
    private static function _getVoiceType($fileStream){
        //mp3/wma/wav
        self::$fileFormat = self::TYPE_VOICE;
        $typeCode = intval($fileStream['chars1'].$fileStream['chars2']);
        switch ($typeCode)
        {
            case 7368:
                self::$fileType = 'mp3';
                break;
        }
    }

    /**
     * 获取音乐格式的文件类型
     * @return mixed
     */
    private static function _getMusicType($fileStream){
        self::$fileFormat = self::TYPE_MUSIC;
    }

    /**
     * 获取视频格式的文件类型
     * @return mixed
     */
    private static function _getVideoType($fileStream){
        self::$fileFormat = self::TYPE_VIDEO;
    }

    /**
     * 获取压缩文件格式的文件类型
     * @return mixed
     */
    private static function _getNarrowType($fileStream){
        self::$fileFormat = self::TYPE_NARROW;
        $typeCode = intval($fileStream['chars1'].$fileStream['chars2']);
        switch ($typeCode)
        {
            case 8297:
                self::$fileType = 'rar';
                break;
        }
    }

    /**
     * 获取EXE格式的文件类型
     * @return mixed
     */
    private static function _getExeType($fileStream){

    }

    /**
     * 根据文件路径拿到文件流
     * @return mixed
     */
    private static function _getFileStream($filePath){
        //本地图片
        if(file_exists($filePath)){
            $file = fopen($filePath, "rb");
            //只读2字节
            $bin = fread($file, 2);
            fclose($file);
            return @unpack("c2chars", $bin);
        }
        //网络图片
        if(strpos($filePath,'http://') !== false){
            $file = file_get_contents($filePath);
            //截取前2个字节
            $bin = substr($file,0,2);
            return @unpack("c2chars", $bin);
        }
        return false;
    }

}

