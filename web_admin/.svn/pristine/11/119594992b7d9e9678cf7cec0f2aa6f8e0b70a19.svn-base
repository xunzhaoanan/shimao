<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/10
 * Time: 15:00
 */

namespace common\services\login;

use common\cache\Session;
use common\models\Login;
use common\models\Shop;
use common\services\BaseService;
use Yii;

class LoginService extends BaseService
{
    protected $loginModel;


    public function init()
    {
        $this->loginModel = new Login();
    }

    /**
     * qq登陆
     */
    private function _qqLogin($params)
    {
        $apiParams = [
            'qq' => $params['qq'],
            'token' => $params['token'],
        ];
        $this->loginModel->qqLogin($apiParams);
        // 接收数据层处理结果
        if (!is_null($this->loginModel->getError())) {
            $this->setError($this->loginModel->getError());
            return false;
        }
        return $this->loginModel->_data;
    }

    /**
     * 管理员登陆
     */
    private function _managerLogin($params)
    {
        $apiParams = [
            'qq' => $params['username'],
            'password' => $params['password'],
        ];
        $this->loginModel->managerLogin($apiParams);
        // 接收数据层处理结果
        if (!is_null($this->loginModel->getError())) {
            $this->setError($this->loginModel->getError());
            return false;
        }
        return $this->loginModel->_data;
    }

    /**
     * 商户后台 登陆
     */
    public function managerLogin($params)
    {

        if (isset($params['token'])) {
            $result = $this->_qqLogin($params);
        } else {
            $result = $this->_managerLogin($params);
        }
        if (!$result) {
            return false;
        }
        $manager = $result['shop_manager'];
        $user = [
            'id' => $manager['id'],
            'nickName' => $manager['qq'],
            'roleId' => 1,
            'roleName' => '管理员',
            'position' => 'manager',
        ];
        // 处理数据层返回的结果
        $result = $this->loginModel->_data;

        Session::clear();
        if ($result['shop']['is_restaurant'] == Shop::IS_RESTAURANT_NO) {
            Session::set(Session::SESSION_KEY_MANAGER, $result['shop_manager']);
            Session::set(Session::SESSION_KEY_STAFF, $result['shop_staff']);
            Session::set(Session::SESSION_KEY_USER, $user);
            Session::set(Session::SESSION_KEY_SHOP, $result['shop']);
            Session::set(Session::SESSION_KEY_PERMISSION, $result['permissions']);
        }
        return $result;
    }

    //员工登录
    public function staffLogin($params)
    {
        //产品允许输入账号中带@符号
//        if(count(explode('@', $params['username'])) !== 2) {
//            $this->setError('账号不存在');
//            return false;
//        }
//        list($userName, $wxAccount) = explode('@', $params['username']);
        $position = strrpos($params['username'], '@');
        $userName = substr($params['username'], 0, $position);
        $wxAccount = substr($params['username'], $position - strlen($params['username']) + 1);

        $apiParams = [
            'user_name' => $userName,
            'password' => $params['password'],
            'wx_account' => $wxAccount,
        ];
        $this->loginModel->staffLogin($apiParams);
        // 接收数据层处理结果
        if (!is_null($this->loginModel->getError())) {
            $this->setError($this->loginModel->getError());
            return false;
        }
        $result = $this->loginModel->_data;
        Session::clear();
        Session::set(Session::SESSION_KEY_SHOPINFO, $result['shop_info']);
        Session::set(Session::SESSION_KEY_STAFF, $result['shop_staff']);
        Session::set(Session::SESSION_KEY_SHOPSUB, $result['shop_sub']);
        Session::set(Session::SESSION_KEY_STAFF, $result['shop_staff']);
        Session::set(Session::SESSION_KEY_SHOP, $result['shop']);
        Session::set(Session::SESSION_KEY_PERMISSION, $result['permissions']);
        //菜单
        $menus = [];
        foreach ($result['menus'] as $val) {
            $menus[$val['key']] = true;
        }
        Session::set(Session::SESSION_KEY_MENU, $menus);
    }

    //  代理商后台 登陆
    public function agentLogin($params)
    {
        $userInfo = explode('@', $params['username']);
        if (count($userInfo) !== 2) {
            $this->setError('账号不存在');
            return false;
        }
        $apiParams = [
            'user_name' => $userInfo[0],
            'password' => $params['password'],
            'wx_account' => $userInfo[1]
        ];
        $this->loginModel->agentLogin($apiParams);
        if (!is_null($this->loginModel->getError())) {
            $this->setError($this->loginModel->getError());
            return false;
        }
        $result = $this->loginModel->_data;
        Session::clear();
        Session::set(Session::SESSION_KEY_AGENT, $result['shop_agent']);
        Session::set(Session::SESSION_KEY_SHOP, $result['shop']);
        Session::set(Session::SESSION_KEY_PERMISSION, $result['permissions']);
        //菜单
        $menus = [];
        foreach ($result['menus'] as $val) {
            $menus[$val['key']] = true;
        }
        Session::set(Session::SESSION_KEY_MENU, $menus);
    }
} 