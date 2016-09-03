<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\newservices;


class User extends BaseService
{


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 商家获取用户积分流水
     */
    public function findPointByShop($params)
    {
        $data = $this->getResult('wxuser-find-point-log-by-shop',$params);
        return $data;
    }

    /**
     * 修改用户信息
     */
    public function updateWxUser($params)
    {
        $data = $this->getResult('wxuser-update-wx-user',$params);
        return $data;
    }

    /**
     * 修改用户信息
     */
    public function getUser($params)
    {
        $data = $this->getResult('wx-user-get',$params,false);
        return $data;
    }


}