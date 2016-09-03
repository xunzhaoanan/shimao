<?php
/**
 * Author: MaChenghang
 * Date: 2015/10/22
 * Time: 22:08
 */

namespace common\helpers;
use common\vendor\request\RequestLib;
use Yii;

class BaseApiHelper
{

    const PARAMS_PAGE = 'page';
    const PARAMS_COUNT = 'count';
    const PARAMS_SORT = 'sortStr';
    const PARAMS_SORT_ASC = 'asc';
    const PARAMS_SORT_DESC = 'desc';
    const PARAMS_FILTER  = '_filter';

    static $requestPrefix = [
        'local'=>'http://dkh_baseapi.baseapiv3.customstest.snsshop.net/v1',
        'dev'=>'http://dkh_baseapi.baseapiv3.customstest.snsshop.net/v1',
        //'beta'=>'http://dkh_baseapi.baseapiv3.customstest.snsshop.net/v1',
        'beta'=>'http://shimao.api.dev',    //世贸测试本地地址
        'online'=>'http://customs.apiv3.com/v1',
        'rc'=>'http://newwshrc.api.com/v1',
    ];

    /**
     * 获取请求的结果
     */
    public static function sync($urlKey, $params , $isFilterNull = true)
    {
        $url = self::$requestPrefix[CODE_RUNTIME] . BaseApiUrlHelper::$keyArray[$urlKey] . '?db='.PROJECTKEY;
        if($isFilterNull){
            $params = CommonFunctionHelper::filterArrayValue($params,null);
        }
        $result = RequestLib::http_post($url,json_encode($params, true));
        // pr($result);
        return $result;

    }

    /**
     * 获取请求结果，世贸项目
     */
    public static function sync_test($urlKey, $params , $isFilterNull = true)
    {
        $url = self::$requestPrefix[CODE_RUNTIME] . BaseApiUrlHelper::$keyArray[$urlKey];
        if($isFilterNull){
            $params = CommonFunctionHelper::filterArrayValue($params,null);
        }
        self::_paramsProcess($params);
        print_r($params);die();
        $result = RequestLib::http_post($url,json_encode($params, true));
        print_r($result);die();
        return $result;

    }

    /**
     * 生成接口所需post参数，带上验证key,json格式
     */
    private static function _paramsProcess(&$params) {
        $params['AppSign'] = self::_getAppSign($params);
        $params['AuthorType'] = AUTHORTYPE;
        $params = json_encode($params);
    }

    /**
     * 生成appSign
     */
    private static function _getAppSign($params) {
        //提前拼接完顺序
        array_multisort($params);
        $strParams = implode('',$params);
        $appSign = MD5($strParams.strtotime(date("YmdHi")).MD5KEY);
        return $appSign;
    }

    /**
     * 发送请求，不需要得到结果
     */
    public static function async($urlKey, $params)
    {
        $url = self::$requestPrefix[CODE_RUNTIME] . BaseApiUrlHelper::$keyArray[$urlKey] . '?db='.PROJECTKEY;
        RequestLib::http_post_async($url,json_encode($params, true));
    }
}