<?php

namespace common\helpers;

use Yii;
use common\helpers\CommonLib;
use common\vendor\upload\cdn\CDN;

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
if (!defined('ROOT')) {
    define('ROOT', dirname(dirname(dirname(__FILE__))));
}

/**
 * 图片操作类
 *
 * @author chenmh
 */
class ImageHelper
{

    public function __construct()
    {
    }

    private $imgSrc;//图片地址
    private $imgType;//图片类型
    public $code = 0, $msg;

    private $imgObj;//图片对象

    public function initImage($imgSrc, $imgType)
    {
        $this->imgSrc = $imgSrc;
        $this->imgType = $imgType;
        $this->imgObj = $this->_getObj($imgSrc, $imgType);
    }

    public function setImgObjFromBase64($streamBase64, $imgType = "jpg")
    {
        $this->imgType = $imgType;
        $this->imgObj = $this->getImgObjFromBase64($streamBase64);
    }

    /**
     * 根据图片地址获取图片流的base64编码
     * @param type $imgSrc
     * @param type $imgType
     * @return type
     */
    public function getImgStreamBase64($imgSrc, $imgType = null)
    {
        if ($imgType == null) {
            $imgType = $this->_getRealExt($imgSrc);
        }
        $imgObj = $this->_getObj($imgSrc, $imgType);
        return base64_encode($this->_getStream($imgObj, $imgType));
    }

    /**
     * 通过base64编码的流转换回图片对象
     * @param type $streamBase64
     * @param type $imgType
     * @return type
     */
    public function getImgObjFromBase64($streamBase64)
    {
        $stream = base64_decode($streamBase64);
        return @imagecreatefromstring($stream);
    }


    public function getStream()
    {

        $new_dst_r = $this->_getStream($this->imgObj);
        if ($this->code !== 0)
            return null;
        $this->_setCode(0);
        return $new_dst_r;
    }

    /**
     * 将外部的地址转为cnd地址
     * @param string $imgSrc
     */
    public function changeToCdn($imgSrc)
    {
        $imgObj = $this->_getObj($imgSrc);
        $new_dst_r = $this->_getStream($imgObj);
        if ($this->code !== 0)
            return null;
        return $this->_getCdnUrl($new_dst_r);
    }

    /**
     * 图片裁剪,返回截取后图片流(可直接上传cdn)
     * @param array $cutInfo
     * @return type
     */
    public function cut($cutInfo)
    {
        if ($this->code !== 0)
            return null;
        $realW = ImageSX($this->imgObj);  //获得图像的宽
        $realH = ImageSY($this->imgObj);  //获得图像的高
        $cutW = $cutInfo['cutW'];//裁剪宽度
        $cutH = $cutInfo['cutH'];//裁剪高度
        $cutL = $cutInfo['cutL'];//裁剪left
        $cutT = $cutInfo['cutT'];//裁剪top
        //生成真彩图
        $dst_r = imagecreatetruecolor($cutW, $cutH);
        //上色
        //$purple = imagecolorallocate( $dst_r, 115, 0, 150 );
        $white = imagecolorallocate($dst_r, 255, 255, 255);
        //设置透明
        imagecolortransparent($dst_r, $white);
        imagefill($dst_r, 0, 0, $white);
        //拷贝图片
        imagecopyresampled($dst_r, $this->imgObj, -$cutL, -$cutT, 0, 0, $realW, $realH, $realW, $realH);

        imagedestroy($this->imgObj);
        $new_dst_r = $this->_getStream($dst_r);
        if ($this->code !== 0)
            return null;
        $this->_setCode(0);
        return $new_dst_r;

    }


    /**
     * 合并2张图片为新图片,返回合并后图片流(可直接上传cdn)，以之前的图片为准
     * @param string $otherPic 地址,将该地址的图片合并进来,也可能是base64编码后的字节流
     * @param int $pos
     * @return string 返回合并后的cnd地址
     */
    /*public function mergeTwo($otherPic,$pos=2,$allowSize= null){
        if ($this->code!==0)
            return null;
        $sourceObj = $this->imgObj;
        $fW = ImageSX($sourceObj);
        $fH = ImageSY($sourceObj);
        if (strpos($otherPic,"http")===0){//说明是url地址
         $otherObj = $this->_getObj($otherPic);
        }
        else{//说明是base64编码后的字节流
           $otherObj = $this->getImgObjFromBase64($otherPic);
        }
        $otherW = ImageSX($otherObj);
        $otherH = ImageSY($otherObj);
        
        //先裁剪然后才合并
        $scalArr = $this->_scalingRule(array('w'=>$fW,'h'=>$fH),$allowSize,array('w'=>$otherW,'h'=>$otherH));
        if ($scalArr['s1']==1){//说明需要裁剪
            $fW = $scalArr['bw'];
            $fH = $scalArr['bh'];
            $sourceObj = $this->_scaling($sourceObj,$fW,$fH);
        }
        if ($scalArr['s2']==1){//说明需要裁剪
            $otherW = $scalArr['nw'];
            $otherH = $scalArr['nh'];
            $otherObj = $this->_scaling($otherObj,$otherW,$otherH);
        }
        //var_dump($scalArr);exit;
        
        switch ($pos){
            case 1://上
            case 2://下
                $newW = $fW;
                $newH = $fH+$otherH;
                break;
        }
        
         //生成真彩图
	$dst_r = imagecreatetruecolor( $newW, $newH );
        //上色
        $white = imagecolorallocate( $dst_r, 255, 255, 255 );
        //设置透明
        imagecolortransparent( $dst_r, $white );
        imagefill( $dst_r, 0, 0, $white );
        
         switch ($pos){
            case 1://上
            imagecopy($dst_r,$otherObj,0,0,0,0,$fW,$otherH);
            imagecopy($dst_r,$sourceObj,0,$otherH,0,0,$fW,$fH);
                break;
            case 2://下
            imagecopy($dst_r,$sourceObj,0,0,0,0,$fW,$fH);
            imagecopy($dst_r,$otherObj,0,$fH,0,0,$fW,$otherH);
                break;
        }
        
        imagedestroy($sourceObj);
        $new_dst_r = $this->_getStream($dst_r);
        if ($this->code!==0)
            return null;
        return $this->_getCdnUrl($new_dst_r);
    }*/
    /**
     *合并多张图片
     * @param <array> $datas 需要合并图片的信息（包括位置，尺寸等）,有可能是文字信息
     * @return <array> $sizeInfo 合并的宽高，没设置的话需要根据图片内容获取
     * @return <array> $margin 图片的边距
     * @return <type>
     */
    public function mergeAll($datas, $sizeInfo = null, $margin = null)
    {

        $maxW = 0;
        $maxH = 0;
        //遍历计算(图片默认是按顺序从上往下合并的)
        foreach ($datas as $key => $info) {
            $v = $info['v'];//图片地址或文字
            $type = isset($info['ty']) ? $info['ty'] : 1;//类型，1为图片，2为文字,3为base64编码的流
            $rely = isset($info['rely']) ? $info['rely'] : null;//依赖于某个键的位置，如依赖的是第1张图片，则值为0
            $w = isset($info['w']) ? $info['w'] : null;//宽，如果没设置则是以该图片为准的，则其宽是合并的宽
            $cutT = isset($info['cutT']) ? $info['cutT'] : 1;//裁剪类型 1为等比例缩放不填充满,2为等比例缩放同时填充满尺寸（系统自动居中裁剪，不够尺寸的放大再裁剪）,0为不处理
            $pos = isset($info['pos']) ? $info['pos'] : 1;//缩后位置 只有当$cutType为1时，才需要设置， 1为全部居中，2为左居中，3为右居中
            $fontSuo = isset($info['fontSuo']) ? $info['fontSuo'] : [1, 1];//文字缩放比例
            if ($w !== null)
                $h = isset($info['h']) ? $info['h'] : null;
            else
                $h = null;
            if ($type == 2) {//说明是文字，
                if ($w === null && $rely !== null)
                    $w = $datas[$rely]['w'];

                $imgObjG = $this->getTextImgStream($v, $w, $h, $fontSuo);
                if ($h === null)
                    $h = ImageSY($imgObjG);
            } else {//说明是图片
                if ($type == 1) {
                    $imgObjG = $this->_getObj($v);
                } else
                    $imgObjG = $this->getImgObjFromBase64($v);
                if ($w !== null && $h !== null) {
                    $imgObjG = $this->_scaling($imgObjG, $w, $h, $cutT, $pos);
                } else if ($w === null) {
                    if ($rely !== null) {//说明有依赖
                        $w = $datas[$rely]['w'];
                        if ($h === null) {//则需要自适应活动高度
                            $h = $this->_getSizeV(ImageSX($imgObjG), ImageSY($imgObjG), 1, $w);
                        }
                        $imgObjG = $this->_scaling($imgObjG, $w, $h, $cutT, $pos);
                    } else {
                        if ($sizeInfo === null) {//说明是根据实际宽高
                            $w = ImageSX($imgObjG);
                            $h = ImageSY($imgObjG);
                        } else {
                            $w = $sizeInfo['w'];
                            if ($h === null) {//则需要自适应活动高度
                                $h = $this->_getSizeV(ImageSX($imgObjG), ImageSY($imgObjG), 1, $w);
                            }
                            $imgObjG = $this->_scaling($imgObjG, $w, $h, $cutT, $pos);
                        }
                    }
                } else {
                    if ($h === null) {//则需要自适应活动高度
                        $h = $this->_getSizeV(ImageSX($imgObjG), ImageSY($imgObjG), 1, $w);
                    }
                    $imgObjG = $this->_scaling($imgObjG, $w, $h, $cutT, $pos);
                }
            }
            $datas[$key]['imgObj'] = $imgObjG;
            $datas[$key]['w'] = $w;
            $datas[$key]['h'] = $h;
            //接下来计算位置
            $left = isset($info['l']) ? $info['l'] : null;
            $top = isset($info['t']) ? $info['t'] : null;
            if ($left === null) {
                if ($rely === null) {//无依赖
                    $left = 0;
                } else {//有依赖
                    $left = $datas[$rely]['w'] + $datas[$rely]['l'];//说明在其右边
                }
            }
            if ($top === null) {
                if ($rely === null) {//无依赖
                    $top = $maxH;//则摆在上一张的下面
                } else {//有依赖
                    $top = $datas[$rely]['h'] + $datas[$rely]['t'];//说明在其下面
                }
            }
            $ml = isset($info['ml']) ? $info['ml'] : 0;//与左边的间距
            $mt = isset($info['mt']) ? $info['mt'] : 0;//与上边的间距
            $mr = isset($info['mr']) ? $info['mr'] : 0;//与右边的间距
            $mb = isset($info['mb']) ? $info['mb'] : 0;//与下边的间距
            $left += $ml;
            $top += $mt;
            $datas[$key]['t'] = $top;
            $datas[$key]['l'] = $left;
            $newH = $top + $h + $mb;
            $newW = $left + $w + $mr;
            $maxH = $maxH > $newH ? $maxH : $newH;
            $maxW = $maxW > $newW ? $maxW : $newW;
        }
        if ($sizeInfo !== null) {
            $maxW = $sizeInfo['w'];
            $maxH = $sizeInfo['h'];
        }
        $ml = 0;
        $mt = 0;
        $mr = 0;
        $mb = 0;
        if ($margin != null) {
            $ml = isset($margin["ml"]) ? $margin["ml"] : 0;
            $mr = isset($margin["mr"]) ? $margin["mr"] : 0;
            $mt = isset($margin["mt"]) ? $margin["mt"] : 0;
            $mb = isset($margin["mb"]) ? $margin["mb"] : 0;
        }
        $maxW += $ml + $mr;
        $maxH += $mt + $mb;
        //生成真彩图
        $dst_r = imagecreatetruecolor($maxW, $maxH);
        //上色
        $white = imagecolorallocate($dst_r, 255, 255, 255);
        //设置透明
        imagecolortransparent($dst_r, $white);
        imagefill($dst_r, 0, 0, $white);
        foreach ($datas as $key => $info) {
            //第1个是x,第2个是y,最后2个是图片的宽高
            imagecopy($dst_r, $info['imgObj'], $info['l'] + $ml, $info['t'] + $mt, 0, 0, $info['w'], $info['h']);
        }
        $new_dst_r = $this->_getStream($dst_r);
        if ($this->code !== 0)
            return null;
        return $this->_getCdnUrl($new_dst_r);
    }

    /**
     *根据限制和文字生成文字图片流
     * @param <type> $word
     * @param int $allowW 允许的宽度
     * @param int $allowH 允许的高度
     * @param array $suoRank 图片缩放比例，从而会影响文字大小
     */
    private function getTextImgStream($word, $allowW, $allowH = null, $suoRank = [1, 1])
    {
        $info = $this->_getTextImgInfo($word, $allowW, $allowH, $suoRank);
        $im = imagecreate($info['w'], $info['h']);
        $white = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
        imagecolortransparent($im, $white);  //imagecolortransparent() 设置具体某种颜色为透明色，若注释
        $black = imagecolorallocate($im, 0x00, 0x00, 0x00);
        foreach ($info['line'] as $v) {
            imagettftext($im, $this->_fontSize[2], 0, $this->_contentML, $v['b'], $black, ROOT . DS . 'files' . DS . 'simhei.ttf', $this->to_entities($v['word'])); //字体设置部分
        }
        return $im;
    }

    private $_fontSize = array(19, 18, 14);//单个字体的宽高，以及尺寸大小
    private $_contentMT = 8;//内容与顶部的间距
    private $_contentML = 8;//内容与左边的距离
    private $_contentMR = 8;//内容与右边的距离
    private $_contentMB = 8;//内容与底部的距离
    private $_fontInterval = 8;//字体上下之间间距

    /**
     * 根据宽度和文字获取各行文字的位置以及总宽高
     * @param string $word
     * @param int $allowW 允许的宽度
     * @param int $allowH 允许的高度，如果没设置则根据字体算高度，如果设置了的话，内容将居中
     */
    private function _getTextImgInfo($word, $allowW, $allowH = null, $suoRank = [1, 1])
    {
        $this->_fontSize[0] *= $suoRank[0];//单个字体宽度
        $this->_fontSize[1] *= $suoRank[1];//单个字体高度
        $this->_fontSize[2] *= min($suoRank[0], $suoRank[1]);//字体尺寸
        $this->_contentMT *= $suoRank[1];
        $this->_contentML *= $suoRank[0];
        $this->_contentMR *= $suoRank[0];
        $this->_contentMB *= $suoRank[1];
        $this->_fontInterval *= $suoRank[1];

        if ($allowH !== null && $this->_contentMT + $this->_fontSize[1] > $allowH)
            return false;
        //先获取字体的字节数
        $num = CommonLib::absLength($word);

        $back = array('w' => $allowW);

        //计算需要多少行
        $lineFontNum = floor(($allowW - $this->_contentML - $this->_contentMR) / $this->_fontSize[0]);//一行的个数
        $lineNum = ceil($num / $lineFontNum);//需要的行数
        $v = $this->_contentML;

        for ($i = 0; $i < $lineNum; $i++) {
            $offSet = $i * $lineFontNum;
            $v += $this->_fontSize[1];
            $back['line'][] = array('b' => $v, 'word' => CommonLib::utf8Substr($word, $offSet, $lineFontNum));
            if ($allowH != null && $v + $this->_fontSize[1] + $this->_fontInterval > $allowH) {//说明超过限制，则超过的字体不显示
                break;
            }
            $v += $this->_fontInterval;
        }
        if ($allowH == null) {
            $allowH = $v + $this->_contentMB;//获取需要的高度
        }
        //计算是否需要偏移
        if ($v + $this->_contentMB < $allowH) {//说明需要，进行居中处理
            $overH = $allowH - ($v + $this->_contentMB);
            $offV = floor($overH / 2);
            if ($offV > 0) {
                foreach ($back['line'] as $key => $v) {
                    $back['line'][$key]['b'] = $v['b'] + $offV;
                }
            }
        }
        $back['h'] = $allowH;
        return $back;
    }

    /**
     * 解决中文字体乱码问题
     * @param type $string
     * @return type
     */
    private function to_entities($string)
    {
        $len = strlen($string);
        $buf = "";
        for ($i = 0; $i < $len; $i++) {
            if (ord($string[$i]) <= 127) {
                $buf .= $string[$i];
            } else if (ord($string[$i]) < 192) {
                //unexpected 2nd, 3rd or 4th byte
                $buf .= "&#xfffd";
            } else if (ord($string[$i]) < 224) {
                //first byte of 2-byte seq
                $buf .= sprintf("&#%d;",
                    ((ord($string[$i + 0]) & 31) << 6) +
                    (ord($string[$i + 1]) & 63)
                );
                $i += 1;
            } else if (ord($string[$i]) < 240) {
                //first byte of 3-byte seq
                $buf .= sprintf("&#%d;",
                    ((ord($string[$i + 0]) & 15) << 12) +
                    ((ord($string[$i + 1]) & 63) << 6) +
                    (ord($string[$i + 2]) & 63)
                );
                $i += 2;
            } else {
                //first byte of 4-byte seq
                $buf .= sprintf("&#%d;",
                    ((ord($string[$i + 0]) & 7) << 18) +
                    ((ord($string[$i + 1]) & 63) << 12) +
                    ((ord($string[$i + 2]) & 63) << 6) +
                    (ord($string[$i + 3]) & 63)
                );
                $i += 3;
            }
        }
        return $buf;
    }

    /**
     * 图片自动缩放
     * @param string $imgSrc
     * @param array $allowSize 允许的最大尺寸
     * @return string 返回缩放后的地址
     */
    public function scaling($imgSrc, $allowSize = null)
    {
        if ($allowSize == null)
            return $imgSrc;
        $imgObj = $this->_getObj($imgSrc);
        $w = ImageSX($imgObj);
        $h = ImageSY($imgObj);
        $arr = $this->_scalingRule(array('w' => $w, 'h' => $h), $allowSize, null);
        if ($arr['s1'] === 0)
            return $imgSrc;
        $imgObj = $this->_scaling($imgObj, $w, $h);
        $new_dst_r = $this->_getStream($imgObj);
        if ($this->code !== 0)
            return null;
        return $this->_getCdnUrl($new_dst_r);
    }

    /**
     * 将流上传到cnd获得图片地址
     * @param type $imgStream
     * @param string $ext
     * @return string
     */
    private function _getCdnUrl($imgStream, $ext = "jpg")
    {
        CDN::uploadFileRaw($imgStream, Commonlib::createGuid(), 'jpg');
        $res = CDN::$cdnData;
        if ($res === false) {
            $this->code = 100;
            $this->msg = "上传CDN失败";
            return false;
        }
        $cdnInfo = json_decode($res, true);
        if (!is_array($cdnInfo)) {
            $this->code = 100;
            $this->msg = "上传CDN失败";
            return false;
        }
        $this->_setCode(0);
        return $cdnInfo['url'];
    }

    /**
     * 缩放图片
     * @param type $img_obj
     * @param int $w 缩放后的宽
     * @param int $h 缩放后的高
     * @param int $cutType 1为等比例缩放不填充满,2为等比例缩放同时填充满尺寸（系统自动居中裁剪，不够尺寸的放大再裁剪）,0为不处理
     * @param int $position 只有当$cutType为1时，才需要设置， 1为全部居中，2为左居中，3为右居中
     * @return type
     */
    private function _scaling($img_obj, $w, $h, $cutType = 1, $position = 1)
    {
        $oW = ImageSX($img_obj);
        $oH = ImageSY($img_obj);
        if ($oW == $w && $oH == $h)//不需要裁减
            return $img_obj;
        if ($cutType === 0) {//不裁剪，直接拉伸
            $newObj = ImageCreateTrueColor($w, $h);
            //上色
            $white = imagecolorallocate($newObj, 255, 255, 255);
            //设置透明
            imagecolortransparent($newObj, $white);
            imagefill($newObj, 0, 0, $white);
            imagecopyresampled($newObj, $img_obj, 0, 0, 0, 0, $w, $h, $oW, $oH);
            imagedestroy($img_obj);
            return $newObj;
        }
        //按比例改，不足的补空白
        $sizeArr = $this->_getScalingPosition(array('w' => $oW, 'h' => $oH), array('w' => $w, 'h' => $h), $cutType, $position);
        if ($cutType != 1) {
            $newObj = ImageCreateTrueColor($w, $h);
            //上色
            $white = imagecolorallocate($newObj, 255, 255, 255);
            //设置透明
            imagecolortransparent($newObj, $white);
            imagefill($newObj, 0, 0, $white);
            imagecopyresampled($newObj, $img_obj, 0, 0, $sizeArr['l'], $sizeArr['t'], $w, $h, $sizeArr['w'], $sizeArr['h']);
            imagedestroy($img_obj);
            return $newObj;
        }
        if ($sizeArr['c'] === 1) {//说明需要重新缩
            $newObj = ImageCreateTrueColor($sizeArr['w'], $sizeArr['h']);
            //上色
            $white = imagecolorallocate($newObj, 255, 255, 255);
            //设置透明
            imagecolortransparent($newObj, $white);
            imagefill($newObj, 0, 0, $white);
            imagecopyresampled($newObj, $img_obj, 0, 0, 0, 0, $sizeArr['w'], $sizeArr['h'], $oW, $oH);
            $img_obj = $newObj;
            $oW = $sizeArr['w'];
            $oH = $sizeArr['h'];
        }
        $newObj = ImageCreateTrueColor($w, $h);

        //上色
        $white = imagecolorallocate($newObj, 255, 255, 255);
        //设置透明
        imagecolortransparent($newObj, $white);
        imagefill($newObj, 0, 0, $white);

        imagecopy($newObj, $img_obj, $sizeArr['l'], $sizeArr['t'], 0, 0, $oW, $oH);

        //imagecopyresampled($newObj,$img_obj, $sizeArr['l'], $sizeArr['t'], 0, 0, $w, $h,$oW,$oH);
        imagedestroy($img_obj);
        return $newObj;
    }

    /**
     * 根据允许的尺寸缩，以及位置
     * @param array $size
     * @param array $allowSize
     * @param int $cutType 1为等比例缩放不填充满,2为等比例缩放同时填充满尺寸（系统自动居中裁剪，不够尺寸的放大再裁剪）
     * @param int $position 只有当$cutType为1时，才需要设置， 1为全部居中，2为左居中，3为右居中
     * @return array
     */
    private function _getScalingPosition($size, $allowSize, $cutType = 1, $position = 1)
    {
        if ($cutType != 1) {
            return $this->_getScalingFull($size, $allowSize);
        }
        $bW = (int)$size['w'];
        $bH = (int)$size['h'];
        $allowW = (int)$allowSize['w'];//最大允许的宽度
        $allowH = (int)$allowSize['h'];//最大允许的高度
        if ($bW > $allowW || $bH > $allowH) {//尺寸超限
            $rate1 = $bW / $allowW;
            $rate2 = $bH / $allowH;
            $w = $rate1 > $rate2 ? $bW / $rate1 : $bW / $rate2;//缩后的宽
            $h = $rate1 > $rate2 ? $bH / $rate1 : $bH / $rate2;//缩后的高
            $needC = 1;
        } else {
            $w = $bW;
            $h = $bH;
            $needC = 0;
        }
        switch ($position) {
            case 2://左居中
                $left = 0;
                $top = ($allowH - $h) / 2;
                break;
            case 3://右居中
                $left = $allowW - $w;
                $top = ($allowH - $h) / 2;
                break;
            default :
                $left = ($allowW - $w) / 2;
                $top = ($allowH - $h) / 2;
                break;
        }
        return array('w' => (int)$w, 'h' => (int)$h, 'l' => (int)$left, 't' => (int)$top, 'c' => $needC);
    }

    /**
     * 等比例缩放同时填充满尺寸
     * @param array $size
     * @param array $fullSize 需要填充满的尺寸
     * @return array
     */
    private function _getScalingFull($size, $fullSize)
    {

        $bW = (int)$size['w'];
        $bH = (int)$size['h'];
        $fullW = (int)$fullSize['w'];//需填充的宽度
        $fullH = (int)$fullSize['h'];//需填充的高度
        if ($bW >= $fullW && $bH >= $fullH) {//宽高都超过填充尺寸
            $rate1 = $bW / $fullW;
            $rate2 = $bH / $fullH;
            if ($rate1 == $rate2) {//刚好等比例缩
                $left = 0;
                $top = 0;
                $w = $bW;
                $h = $bH;
                $needC = $rate1 == 1 ? 0 : 1;
            } else {//说明需要裁剪
                $needC = 1;
                $rate = min($rate1, $rate2);//选取小的
                $w = (int)($bW / $rate);//缩后的宽
                $h = (int)($bH / $rate);//缩后的高
                //需要计算移动的值
                if ($w > $fullW) {//说明宽度超过限制
                    $top = 0;
                    $left = ($w - $fullW) * $rate / 2;
                    $w = (int)($bW - $left * 2);
                    $h = $bH;
                } else {
                    $left = 0;
                    $top = ($h - $fullH) * $rate / 2;
                    $w = $bW;
                    $h = (int)($bH - $top * 2);
                }
            }
        } else {//说明尺寸小于填充尺寸

            $rate1 = $fullW / $bW;
            $rate2 = $fullH / $bH;
            $needC = 1;
            if ($rate1 == $rate2) {//刚好等比例放
                $left = 0;
                $top = 0;
                $w = $bW;
                $h = $bH;
            } else {//说明需要扩大裁剪
                $rate = max($rate1, $rate2);//选取小的
                $w = (int)($bW * $rate);//放大后的宽
                $h = (int)($bH * $rate);//放大后的高
                //需要计算移动的值
                if ($w > $fullW) {//说明宽度超过限制
                    $top = 0;
                    $left = ($w - $fullW) / $rate / 2;
                    $w = (int)($bW - $left * 2);
                    $h = $bH;
                } else {
                    $left = 0;
                    $top = ($h - $fullH) / $rate / 2;
                    $w = $bW;
                    $h = (int)($bH - $top * 2);
                }
            }
        }
        return array('w' => (int)$w, 'h' => (int)$h, 'l' => (int)$left, 't' => (int)$top, 'c' => $needC);
    }

    /**
     * 根据缩放规则生成缩放后的尺寸(2张图片的话只适合头尾合并的)
     * @param array $bSize 依靠图片的尺寸
     * @param array $allowSize 最大允许的尺寸
     * @param array $nSize 另一张图片的尺寸
     * @return array
     */
    private function _scalingRule($bSize, $allowSize, $nSize)
    {
        $bW = $bSize['w'];
        $bH = $bSize['h'];

        $w = $bW; //合并后的宽
        if ($nSize != null) {//先将该图片按打印图片尺寸缩放
            $nW = $nSize['w'];
            $nH = $nSize['h'];
            //以基准图片的宽为准,获取信的高
            $rate = $bW / $nW;
            $nH_n = (int)$nH * $rate;
        } else {
            $nH_n = 0;
        }
        $h = $bH + $nH_n;//合并后的高
        // 
        //如果设置了最大允许尺寸，则需判断是否需要缩
        if ($allowSize != null) {
            $allowW = $allowSize['w'];//最大允许的宽度
            $allowH = $allowSize['h'];//最大允许的高度
            if ($bW > $allowW || $bH > $allowH) {//尺寸超限
                $rate1 = $w / $allowW;
                $rate2 = $h / $allowH;
                $w = $rate1 > $rate2 ? (int)$w / $rate1 : (int)$w / $rate2;//缩后的宽
                $h = $rate1 > $rate2 ? (int)$h / $rate1 : (int)$h / $rate2;//缩后的高
            }
        }

        if ($nSize == null) {//说明是单张图
            if ($bW == $w) {//说明无修改（0代表无修改，1代表有修改尺寸）
                return array('s1' => 0, 'bw' => $bW, 'bh' => $bH);
            } else {
                return array('s1' => 1, 'bw' => $bW, 'bh' => $bH);
            }
        }
        //接下来说明是2图合并
        $backArr = array();
        if ($bW == $w) {//说明原图没变
            $backArr['s1'] = 0;
            //$bH = $bH;//则基准图的高
        } else {
            $backArr['s1'] = 1;
            //获取修改后的原图高度
            $bH = (int)$bH * $w / $bW;//基准图的高
        }
        $backArr['bw'] = $w;
        $backArr['bh'] = $bH;

        if ($nW == $w) {//说明原图没变
            $backArr['s2'] = 0;
            //$nH_n = $nH;
        } else {
            $backArr['s2'] = 1;
            //获取修改后的原图高度
            $nH = $h - $bH;
        }
        $backArr['nw'] = $w;
        $backArr['nh'] = $nH;

        return $backArr;
    }

    private function _getStream($dst_r, $imgType = null)
    {
        // 得到处理后的图片流
        ob_start();
        if ($imgType == null)
            $imgType = $this->imgType;
        if (empty($imgType))
            $imgType = 'jpg';
        $imgType = strtolower($imgType);
        switch ($imgType) {
            case ".jpg":
            case "jpg":
            case ".jpeg":
            case "jpeg":
                imagejpeg($dst_r);
                break;
            case ".png":
            case "png":
                imagepng($dst_r);
                break;
            default:
                @imagejpeg($dst_r);
                break;
        }
        $new_dst_r = ob_get_contents();
        ob_end_clean();
        //释放图片
        imagedestroy($dst_r);
        return $new_dst_r;
    }

    /**
     * 获取图片对象
     * 通过文件或网络地址
     */
    private function _getObj($imgSrc, $imgType = null)
    {
        if ($imgType == null) {
            $imgType = $this->_getRealExt($imgSrc);
        }
        $imgType = strtolower($imgType);
        switch ($imgType) {
            case ".jpg":
            case "jpg":
            case ".jpeg":
            case "jpeg":
                $img_r = @imagecreatefromjpeg($imgSrc);
                break;
            case ".png":
            case "png":
                $img_r = @imagecreatefrompng($imgSrc);
                break;
            default://默认图片
                $img_r = @imagecreatefromjpeg($imgSrc);
                break;
        }
        return $img_r;
    }

    /**
     *根据实际的宽高，等比例算出宽或搞
     * @param <int> $rW 实际的宽
     * @param <int> $rH 实际的高
     * @param <int> $kind 1为获取展示的高，2为获取展示的宽
     * @param <int> $v  当kind是1时表示展示的宽的值，2时表示展示的高的值
     */
    private function _getSizeV($rW, $rH, $kind, $v)
    {
        if ($kind == 1) {
            $rate = $rW / $v;
            return (int)$rH / $rate;
        } else {
            $rate = $rH / $v;
            return (int)$rW / $rate;
        }
    }

    /**
     * 根据图片地址获取扩展
     * @param type $imgSrc
     * @return type
     */
    private function _getExt($imgSrc)
    {
        $pos = strrpos($imgSrc, ".");
        $ext = @substr($imgSrc, $pos + 1);
        if (empty($ext))
            return 'jpg';
        $exts = array('jpg', 'jpeg', 'bmp', 'gif', 'png');
        if (!in_array($ext, $exts))
            return 'jpg';
        return $ext;
    }

    /**
     * 获取后缀
     * @param type $imgSrc 文件地址
     * @return type
     */
    private function _getRealExt($imgSrc)
    {
        $info = getimagesize($imgSrc);
        $filetype = $info['mime'];//获取实际的文件类型
        $ext = null;
        switch ($filetype) {
            case 'image/jpeg':
                $ext = 'jpg';
                break;
            case 'image/jpg':
                $ext = 'jpg';
                break;
            case 'image/pjpeg':
                $ext = 'jpg';
                break;
            case 'image/gif':
                $ext = 'gif';
                break;
            case 'image/png':
                $ext = 'png';
                break;

        }
        if ($ext === null)
            $ext = $this->_getExt($imgSrc);
        return $ext;
    }

    private function _setCode($code, $msg = null)
    {
        $this->code = $code;
        $this->msg = $msg;
    }

    /**
     * 上传文件
     * @param array $file
     * @param string $name 文件名
     * @param array $limitInfo 限制条件
     * @return array
     */
    public function upload($file, $name, $limitInfo, $alias = null)
    {
        $maxSize = isset($limitInfo['maxSize']) ? $limitInfo['maxSize'] : 300;
        $limitExt = isset($limitInfo['ext']) ? $limitInfo['ext'] : null;
        if (empty($alias))
            $alias = str_replace(strrchr($file['name'], "."), "", $file['name']);

        //判断文件大小是否大于允许的
        if ((filesize($file['tmp_name'])) > $maxSize * 1024) {

            return array('state' => 2, 'msg' => '上传文件不能大于' . $maxSize . 'K');
        }
        //判断媒体是否损坏
        if ($file['error'] != 0) {
            return array('state' => 1, 'msg' => '传失败，文件有误：' . $file['error']);
        } else {
            $info = @getimagesize($file['tmp_name']);
        }


        /*[CDN 接管]*/
        //获得文件类型ContentType处理
        $filetype = $file['type'];
        $ext = '';
        switch ($filetype) {
            case 'image/jpeg':
                $ext = 'jpg';
                break;
            case 'image/jpg':
                $ext = 'jpg';
                break;
            case 'image/pjpeg':
                $ext = 'jpg';
                break;
            case 'image/gif':
                $ext = 'gif';
                break;
            case 'image/png':
                $ext = 'png';
                break;

        }
        if (empty($ext)) {
            $fileName = $file['name'];
            $pos = strrpos($fileName, ".");
            $ext = substr($fileName, $pos + 1);
        }
        $ext = strtolower($ext);
        if ($limitExt != null) {
            $arr = explode(',', $limitExt);
            if (!in_array($ext, $arr)) {
                return array('state' => 3, 'msg' => '格式有误,只能传' . $limitExt);
            }
        }

        //使用CDN接口 [CDN 接管]
        CDN::uploadFile($file['tmp_name'], $name, $ext);
        $res = CDN::$cdnData;
        if ($res === false) {
            return array('state' => 4, 'msg' => '上传CDN失败');
        }
        $cdnInfo = json_decode($res, true);

        //获得文件上传地址$Url [CDN 接管]
        $Url = $cdnInfo['url'];

        if ($Url == "") {
            return array('state' => 5, 'msg' => '获取文件地址错误');
        }
        $back = array();
        $back['state'] = 0;
        $back['width'] = isset($info[0]) ? $info[0] : 0;
        $back['height'] = isset($info[1]) ? $info[1] : 0;
        $back['name'] = $name;
        $back['ext'] = $ext;
        $back['alias'] = $alias;
        $back['cdn_url'] = $Url;
        $back['md_name'] = $cdnInfo['key'];
        return $back;
    }
}
