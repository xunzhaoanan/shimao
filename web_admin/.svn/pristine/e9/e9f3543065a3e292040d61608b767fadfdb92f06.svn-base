<?php
/**
 * Author: allyliu
 * Date: 2016/2/26
 * Time: 14:14
 */

namespace common\models;


class ThirdPartyApplication extends BaseModel
{
    const AUTH_LOGIN_URL = '/h3/auth/shop-empower';
    const GET_LIST_URL = '/h3/auth/find-empower';

    /**
     * 获取第三方应用列表
     * @param $params
     * [
     *  'shop_id' => 30,
     *  'page' => 1,
     *  'count' => 10
     * ]
     * @return string
     */
    public function applicationFind($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        return $this->postCurl(OPEN_HOST . self::GET_LIST_URL, $apiParams);
    }

    /**
     * 应用授权登陆地址
     * @return string
     */
    public function applicationUrl()
    {
        return OPEN_HOST . self::AUTH_LOGIN_URL;
    }
}