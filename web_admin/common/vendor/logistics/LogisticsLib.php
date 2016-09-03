<?php
/**
 * Author: MaChenghang
 * Date: 2015/7/7
 * Time: 14:19
 */

namespace common\vendor\logistics;

class LogisticsLib {

    /**
     * 得到物流api的链接
     * @return mixed
     */
    public static function get($params){
        $apiUrl = 'http://m.kuaidi100.com/index_all.html';
        $type = isset($params['express_type']) ? $params['express_type'] : '';
        $postid = isset($params['express_no']) ? $params['express_no'] : '';
        $callback = isset($params['_backurls']) ? $params['_backurls'] : '';

        $apiUrl .= '?type='.$type ;
        $apiUrl .= '&postid='.$postid ;
        $apiUrl .= '&callbackurl='.$callback ;
        return $apiUrl;
    }

}

