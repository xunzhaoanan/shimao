<?php
/**
 * Author: MaChenghang
 * Date: 2015/10/22
 * Time: 22:08
 */

namespace common\helpers;

use Yii;


class JsApiHelper
{

    const PARAMS_PAGE = '_page';
    const PARAMS_COUNT = '_page_size';


    /**
     * 输出错误信息
     */
    public static function setError($errMsg, $errCode)
    {
        if(YiiHelper::isRequestGet()){
            header("Content-type: text/html; charset=utf-8");
            CommonFunctionHelper::redirect('/shop/error?errcode='.$errCode.'&errmsg='.$errMsg);
        }else{
            exit('{"errcode":'.$errCode.',"errmsg":' . json_encode($errMsg) . '}');
        }
    }

    /**
     * 输出请求结果集
     */
    public static function setResult($errMsg)
    {
        exit('{"errcode":' . JsApiCodeHelper::CODE_SUCCESS . ' ,"errmsg":' . json_encode($errMsg) . '}');
    }


}