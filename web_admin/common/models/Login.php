<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/10
 * Time: 15:00
 * 商品类
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * shop model
 */
class Login extends BaseModel
{

    const ONLINE_HOST_KEY = 'gaopeng';
    const ONLINE_LOGIN_URL = 'http://shanghu.qq.com/help/auth/logout';

    public function get($params)
    {
        $apiParams = [
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null ,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $apiData = $this->postCurl('shanghu-login',$apiParams);
        return $apiData;
    }

    public function staffLogin($params)
    {
        $apiParams = [
            'user_name' => isset($params['user_name']) ? $params['user_name'] : null,
            'password' => isset($params['password']) ? $params['password'] : null,
            'wx_account' => isset($params['wx_account']) ? $params['wx_account'] : null
        ];
        $this->getResult('staff-login',$apiParams);
    }

    public function managerLogin($params)
    {
        $apiParams = [
            'qq' => isset($params['qq']) ? $params['qq'] : null,
            'password' => isset($params['password']) ? $params['password'] : null
        ];
        $this->getResult('manager-login',$apiParams);
    }

    public function qqLogin($params)
    {
        $apiParams = [
            'qq' => isset($params['qq']) ? $params['qq'] : null,
            'token' => isset($params['token']) ? $params['token'] : null
        ];
        $this->getResult('qq-login',$apiParams);
    }

    public function agentLogin($params)
    {
        $apiParams = [
            'user_name' => isset($params['user_name']) ? $params['user_name'] : null,
            'password' => isset($params['password']) ? $params['password'] : null,
            'wx_account' => isset($params['wx_account']) ? $params['wx_account'] : null
        ];
        $this->getResult('agent-login',$apiParams);
    }

}
