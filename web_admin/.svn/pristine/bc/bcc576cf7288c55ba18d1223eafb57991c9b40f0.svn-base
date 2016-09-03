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
        'beta'=>'http://dkh_baseapi.baseapiv3.customstest.snsshop.net/v1',
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
     * 发送请求，不需要得到结果
     */
    public static function async($urlKey, $params)
    {
        $url = self::$requestPrefix[CODE_RUNTIME] . BaseApiUrlHelper::$keyArray[$urlKey] . '?db='.PROJECTKEY;
        RequestLib::http_post_async($url,json_encode($params, true));
    }
}