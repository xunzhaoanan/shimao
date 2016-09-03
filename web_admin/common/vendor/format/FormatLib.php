<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/17
 * Time: 14:19
 */

namespace common\vendor\format;

class FormatLib {


    /**
     * 截取小数
     * @length 保留小数点后的位数
     * @return mixed
     */
    public static function cutFloat($float,$length){
        $start = strpos($float,'.') ;
        if($start !== false){
            ++$start;
            return substr($float,0,$start+$length);
        }else{
            return $float.'.00';
        }
        return false;
    }

}

