<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */

namespace admin\controllers;

use common\cache\Session;
use common\helpers\BaseApiHelper;
use common\helpers\CommonFunctionHelper;
use common\helpers\JsApiCodeHelper;
use common\helpers\JsApiHelper;
use common\helpers\ShanghuFunctionHelper;
use common\helpers\YiiHelper;
use common\models\Permission;
use common\newcontrollers\BaseController;
use common\newservices\NewShop;
use common\newservices\NewShopBindWx;
use common\newservices\NewShopPlatform;
use Yii;
use yii\base\Controller;

/**
 * Class BaseForm
 * @package wsh\shanghu\forms
 */
class NewBaseController extends BaseController
{
    //校验前端 csrf 攻击
    public $enableCsrfValidation = true;

    protected $_manager = NULL; //管理员信息
    protected $_shop = NULL; //商家信息
    protected $_wxInfo = NULL; //商家绑定微信信息

    private $shopService;//商家逻辑
    private $platformService; //平台逻辑


    public function __construct($id, $module, $config)
    {
        parent::__construct($id, $module, $config);

        $this->shopService = new NewShop();
        //考虑到现在只用到了微信平台，直接用微信的
        $this->platformService = new NewShopBindWx();
        // 验证请求合法性
        $this->_checkRequest();
        // 验证当前页面用户状态信息
        $this->_checkState();

    }

    /**
     * 验证当前页面用户状态信息
     */
    private function _checkState(){
        //登录相关页面
        $route = '/'.YiiHelper::getApp()->requestedRoute;
        if($route == ShanghuFunctionHelper::ROUTE_LOGIN){
            return true;
        }
        //获取管理员身份
        $this->_manager = ShanghuFunctionHelper::getManager();
        //已经登录的情况
        if($this->_manager){
            Session::set('CURLOPT_HTTPHEADER',array (
                'X-User-ID:'.$this->_manager['id'],
                'X-User-Name:'.$this->_manager['name'],
                'X-User-Type:4'
            ));
            // 初始化用户数据
            return $this->_initUser();
        }
        //不需要登录的页面
        if(ShanghuFunctionHelper::isVisitorRoute($route)){
            return true;
        }
        //未登录
        if(YiiHelper::isRequestGet()) {
            ShanghuFunctionHelper::redirectToLogin();
        }else{
            $this->setError('登陆超时');
        }
    }

    /**
     * 初始化用户数据
     */
    private function _initUser(){
        $this->_shop = $this->_getShop();
        ShanghuFunctionHelper::setShop($this->_shop);
        $this->checkOverdue();
        $this->_wxInfo = $this->_getPlatformWx();
        ShanghuFunctionHelper::setPlatformWx($this->_wxInfo);
        $this->_checkPermission();
    }

    /**
     * 检查商家合同
     */
    private function checkOverdue(){
        if(time() > strtotime($this->_shop['contract_end']) && YiiHelper::getApp()->requestedRoute != 'shop/overdue'){
            $this->redirect('/shop/overdue');
        }
    }

    /**
     * 验证请求合法性
     */
    private function _checkRequest(){
        if( strpos(YiiHelper::getApp()->requestedRoute,'-ajax') === false){
            return true;
        }
//        if ( ! YiiHelper::isRequestPost()) {
//            $this->setError('非法请求');
//        }
    }

    /**
     * 权限验证
     */
    private function _checkPermission(){
        //开发阶段，关闭权限控制
        if(CODE_RUNTIME == CODE_RUNTIME_LOCAL || CODE_RUNTIME == CODE_RUNTIME_DEV){
            return true;
        }
        $class = $this->_class;
        $function = $this->_action;
        if($this->_manager['is_default'] == 1){
            return true;
        }
        //忽略的权限
        $ignore = Permission::$ignoreListByShanghu;
        if(array_key_exists($class,$ignore)){
            if( ! is_array($ignore[$class])){
                return true;
            }else if(in_array($function,$ignore[$class])){
                return true;
            }
        }
        //角色的权限
        if(in_array(Yii::$app->requestedRoute,Session::get(Session::SESSION_KEY_PERMISSION))){
            return true;
        }
        //特殊通用权限处理
        $specialIgnore = Permission::$specialIgnoreListByShanghu;
        if(in_array(Yii::$app->requestedRoute,$specialIgnore)){
            return true;
        }
        //临时处理文件导入(fx/import-csv)
        if($this->id == 'fx' && $this->action->id == 'import-csv'){
            $this->redirect('/fx/import?code=1004');
        }
        if (YiiHelper::isRequestGet()) {
            $this->redirect('/errors/no-access');
        }else{
            $this->setError('没有操作权限',JsApiCodeHelper::CODE_ERROR_ACCESS);
        }
    }

    /**
     * 获取商家信息
     */
    private function _getShop(){
        $params = ['shop_id' => $this->_manager['shop_id']];
        $result = $this->shopService->get($params);
        if( ! $result){
            $this->setError('商家信息不存在或已删除',JsApiCodeHelper::CODE_ERROR_SYSTEM);
        }
        return $result;
    }

    /**
     * 获取商家绑定微信平台信息
     */
    private function _getPlatformWx(){
        $params['shop_id'] = $this->_shop['id'];
        $platform = $this->platformService->getByShopId($params);
        if( ! $platform){
            $this->setError('商家平台信息不存在或已删除',JsApiCodeHelper::CODE_ERROR_SYSTEM);
        }
        $platform['type'] = NewShopPlatform::TYPE_WECHAT;
        return $platform;
    }

    /**
     * 参数格式化
     */
    protected function handleParams($params = [], $filter = true)
    {
        if(count($params) && $filter){
            CommonFunctionHelper::filterArrayValue($params,null);
        }
        //合并必须传入的参数
        $this->_loadMustParams($params);
        return $params;
    }

    /**
     * 添加常规必须传入的参数
     */
    private function _loadMustParams(&$formData){
        $formData['shop_id'] = CommonFunctionHelper::arrayKeyExists($this->_shop,'id') ? $this->_shop['id'] : null;
    }


}
