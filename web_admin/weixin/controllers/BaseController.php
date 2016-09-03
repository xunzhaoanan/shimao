<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/19
 * Time: 10:36
 */

namespace weixin\controllers;

use common\cache\BaseCache;
use common\cache\CartCache;
use common\cache\Session;
use common\helpers\CommonFunctionHelper;
use common\helpers\YiiHelper;
use common\models\Activity;
use common\models\Custompage;
use common\models\FxSetting;
use common\models\Member;
use common\models\Shop;
use common\models\ThirdParty;
use common\services\activity\ActivityService;
use common\services\CommonService;
use common\services\member\MemberService;
use common\vendor\log\AsyncVisitor;
use common\vendor\wechat\WechatOauth;
use Yii;
use yii\base\Controller;


/**
 * Class BaseController
 * @package wsh\weixin\controllers
 */
class BaseController extends Controller
{

    public $_paltInfo = NULL;
    public $_wxInfo = NULL;
    public $_userInfo = NULL;//登陆用户信息
    public $_memberInfo = NULL; //分销员信息
    public $_cartInfo = NULL;//购物车信息
    public $_shop = NULL;//商家信息
    public $_commonService = NULL;
    public $shareFxUrl = null;

    function __construct($id, $module, $config = [] , $wxService = false)
    {
        parent::__construct($id, $module, $config);
        //不需要跳转授权登陆的控制器方法
        $filter = ['oauth/testing','oauth/index','oauth/index-ajax','qrcode/image','magazine/detail','magazine/join-form-ajax','order/notifyurl','reserve/checkindetail','reserve/checkindetail-ajax','activity/wifi-transfer','wifi/newportal','wifi/get-wifi-info-with-other','statement/update-push-msg-status','order/store-address'];
        if( ! $wxService &&  ! in_array(Yii::$app->requestedRoute,$filter)){
            $this->_init();
        }else{
            $this->_initWx();
        }
    }

    /**
     * 常规基类初始化
     */
    private function _init(){
        //Session::clear();
        // 1.先拿到微信配置
        $this->_wxInfo = $this->getWxInfo();
        // 2.商家数据
        $this->_shop = $this->getShop();
        // 3.平台数据
        $this->_paltInfo = ['id' => '1'];
        // 4.用户数据
        $this->_userInfo = $this->getUserInfo();
       // $this->_userInfo = $this->getUserInfo();
        // 5.分销员数据
        $this->_memberInfo = $this->getFxMemberInfo();
        if( ! $this->_userInfo){
            //如果是微信客户端就走授权
            if (Yii::$app->request->headers->has('User-Agent') && strpos(Yii::$app->request->headers->get('User-Agent'), 'MicroMessenger') !== false || strpos(Yii::$app->request->headers->get('User-Agent'), 'MQQBrowser') !== false) {
                if ($this->isServiceAccount()) {
                    if ($this->oauth() !== true) {
                        exit('please login...');
                    } else {
                        // 4.用户数据
                        $this->_userInfo = $this->getUserInfo();
                        // 5.分销员数据
                        $this->_memberInfo = $this->getFxMemberInfo();
                    }
                } else {
                    exit('please login');
                }
            }else{
                if (Yii::$app->request->isGet) {
                    $url = $this->getUrl();
                    $this->redirect(getMobileSite() . '/oauth/index?url='.$url);
                }else{
                    $this->setError('此操作需要授权登陆');
                }
            }
        }
        // 6.购物车数据
	    $this->_cartInfo = $this->getCart();
        // 7.底部样式
        $this->getFooter();
        $this->addAccess();
    }

    /**
     * 页面访问统计
     */
    public function addAccess(){
        return false;
        //只统计页面，不统计数据
        if(Yii::$app->request->isPost){
            return true;
        }
        //不统计微信接口回调
        if($this->getObjType() == 'wxapi'){
            return true;
        }
        //不统计本地环境
        if(CODE_RUNTIME == CODE_RUNTIME_LOCAL){
            return true;
        }
        $option = [
            'shop_id' => $this->_shop['id'],
            'user_id' => isset($this->_userInfo['id']) ? $this->_userInfo['id'] : 0,
            'obj_type' => $this->getObjType(),
            'params_in' => count(YiiHelper::getRequest()->get()) ? json_encode(YiiHelper::getRequest()->get()) : '',
        ];
        $visitor = new AsyncVisitor($option);
        $visitor->addAccess();
    }

    /**
     * 获取访问节点
     */
    private function getObjType(){
        return explode('/',Yii::$app->requestedRoute)[0];
    }

    /**
     * 页面顶部
     */
    public function getFooter(){
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
        ];
        $custompage = new Custompage();
        // 调用逻辑层
        $custompage->getMenu($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($custompage->getError())) {
            return $this->setError($custompage->getError());
        }
        if(is_array($custompage->_data) && count($custompage->_data)){
            $footer =  $custompage->_data;
        }else{
            $footer =  ['navStyle'=>1];
        }
        Session::set(Session::SESSION_KEY_MOBILE_FOOTER,$footer);
    }

    /**
     * 微信基类的初始化
     */
    private function _initWx(){
        //Session::clear();
        // 1.先拿到微信配置
        $this->_wxInfo = $this->getWxInfo();
        // 2.商家数据
        $this->_shop = $this->getShop();
        // 3.平台数据
        $this->_paltInfo = ['id' => '1'];
        // 4.页面统计
        $this->addAccess();
   }

    /**
     * @return bool
     */
    public function beforeAction($action){
        //处理推广员分享链接
        $mid = getGetParams('mid');
        if (in_array(Yii::$app->requestedRoute, ['fx-member/shop', 'fx-member/card', 'fx/qrcode'])) {
            return true;
        }
        $fx_flag = getGetParams('fx_flag');//从推广中心推广出来的链接(暂仅推广的商品详情链接加了这个标识)
        if (!empty($this->_memberInfo['id']) && (($fx_flag != 1) || !$mid) && in_array(Yii::$app->requestedRoute, FxSetting::$filter)) {
            $currentUrl = $this->getUrl();
            if (!$mid) {
                $this->shareFxUrl = count($this->paramsGet()) > 1 ? $currentUrl . '&mid=' . $this->_memberInfo['id'] :
                    $currentUrl . '?mid=' . $this->_memberInfo['id'];
            } elseif ($fx_flag != 1) {
                $this->shareFxUrl = preg_replace("/([?|&]mid=)[^&]*/", '${1}' . $this->_memberInfo['id'], $currentUrl);
            }
        }
        return true;
    }

    /**
     * @param \yii\base\Action $action
     * @param mixed $result
     * @return mixed
     */
    public function afterAction($action, $result){
        //处理用户归属
        $this->processAttrParams();
        return parent::afterAction($action, $result);
    }

    /**
     * 得到购物车门店等数据的key
     */
    public function getShopKey(&$cartParams){
        if( Yii::$app->request->isPost ) {
            $cartParams['mid'] = $this->getPostParams('mid');
        }else{
            $params = $this->paramsGet();
            if(isset($params['mid']) && $params['mid']){
                $cartParams['mid'] = $params['mid'];
            }
        }
    }

    /**
     * 得到 post 的某个参数
     * http_post的时候用的
     */
    public function getPostParams($key)
    {
        if (!isset($_SERVER['HTTP_REFERER'])) {
            return null;
        }
        $referer = $_SERVER['HTTP_REFERER'];
        $strposKey = $key.'=';
        $strposBegin = strpos($referer, $strposKey);
        if ($strposBegin === false) {
            return null;
        }
        $strposBegin += strlen($strposKey);
        $value = substr($referer, $strposBegin);
        $strposKey = '&';
        $strposBegin = strpos($value, $strposKey);
        if ($strposBegin === false) {
            return $value;
        }
        $value = substr($value,0, $strposBegin);
        return $value;
    }

    /**
     * 购物车数据
     */
    public function getCart()
    {
        $cartModel = new CartCache();
        $params = [];
        $this->getShopKey($params);
        $params['shop_id'] = $this->_wxInfo['shop_id'];
        $params['uid'] = $this->_userInfo['id'];
        $cart = $cartModel->getCache($params);
        $result = [];
        if(is_array($cart) && count($cart)){
            foreach ($cart as $val) {
                $result[] = $val;
            }
        }
        return $result;
    }

    /**
     * 得到 http_get 参数
     */
    public function paramsGet(){
        return Yii::$app->request->get();
    }

    /**
     * 得到 http_post 参数
     */
    public function paramsPost(){
        return Yii::$app->request->post();
    }


    /**
     * 刷新用户缓存数据
     */
    public function reflashUser($uid = null)
    {
        if(! $uid){
            $uid = $this->_userInfo['id'];
        }
        $userService = new MemberService();
        $userService->get([
            'shop_id' => $this->_wxInfo['shop_id'],
            'isReflash' => true,
            'user_id' => $uid
        ]);
        if (!is_null($userService->getError())) {
            return $this->setError();
        }
        //用户数据
        $this->setUserInfo($userService->_data);
        $this->_userInfo = $this->getUserInfo();
        //分销员数据
        $this->setFxMemberInfo($userService->_data['fxMember']);
        $this->_memberInfo = $this->getFxMemberInfo();
    }

    /**
     * 得到分页参数
     */
    public function getPageInfo(&$params, $defaultPage = array('page' => 0, 'count' => 20))
    {
        $page = \Yii::$app->request->post('_page');
        $count = \Yii::$app->request->post('_page_size');
        $params['page'] = isset($page) ? intval($page - 1) : $defaultPage['page'];
        $params['count'] = isset($count) ? $count : $defaultPage['count'];
        $params['count'] = $params['count'] > 100 ? 100 : $params['count'];
        if (!isset($params['sortStr'])) {
            $params['sortStr'] = ['id' => 'desc'];
        }
    }

    /**
     * 得到callback的链接
     * http_post的时候用的
     */
    public function getCallback(&$params)
    {
        if (!isset($_SERVER['HTTP_REFERER'])) {
            return false;
        }
        $referer = $_SERVER['HTTP_REFERER'];
        $callbackKey = '_backurls=';
        $strposBegin = strpos($referer, $callbackKey);
        if ($strposBegin === false) {
            return false;
        }
        $callback = substr($referer, $strposBegin);
//        $strposEnd = strpos($callback, '&');
//        if ($strposEnd !== false) {
//            $callback = substr($callback, 0, $strposEnd);
//        }
        $callback = str_replace($callbackKey, '', $callback);
        $params['callback'] = $callback;
    }

    /**
     * 设置callback
     * http_get的时候用
     * 注意！！！view页面用到callback的话，只能是 www.baidu.com?_backurls=$callback&id=。。。形式，backurls必须是第一个参数
     */
    public function setCallback()
    {
        if (!Yii::$app->request->isGet) {
            return '';
        }
        $callback = Yii::$app->request->get('_backurls');
        if (!$callback) {
            return '?_backurls=' . $this->getUrl();
        }
        return '?_backurls=' . $callback;
    }

    /**
     * 跳转url
     */
    public function redirect($url = '/')
    {
        //兼容yii内置的跳转
        if (is_array($url)) {
            $url = $url[0];
        }
        //兼容微信号的跳转
        if (strpos($url, '../') === false && strpos($url, 'http://') === false && strpos($url, 'https://') === false) {
            $url = '../' . $url;
        }
        Header('Location: ' . $url);
        exit;
    }

    /**
     * 检查活动是否开启或过期
     */
    public function checkActivityTime($params,$isRedirect = true)
    {
        $activity = new ActivityService();
        $checkResult = empty($params) ? false : $activity->isActive($params);
        if ($checkResult !== true) {
            switch ($checkResult) {
                //活动关闭的跳转
                case Activity::ERROR_CLOSE_CODED:
                    if (Yii::$app->request->isAjax || Yii::$app->request->isPost) {
                        $this->setError('活动已结束');
                    }
                    if($isRedirect){
                        $this->redirect('../activity/off');
                    }else{
                        return false;
                    }
                    break;
                //活动未开始的跳转
                case Activity::ERROR_UNSTART_CODED:
                    if (Yii::$app->request->isAjax || Yii::$app->request->isPost) {
                        $this->setError('活动未开始');
                    }
                    if($isRedirect){
                        $this->redirect('../activity/unstart');
                    }else{
                        return false;
                    }
                    break;
                //活动过期的跳转
                case Activity::ERROR_EXPIRE_CODED:
                    if (Yii::$app->request->isAjax || Yii::$app->request->isPost) {
                        $this->setError('活动已过期');
                    }
                    if($isRedirect){
                        $this->redirect('../activity/over');
                    }else{
                        return false;
                    }
                    break;
                //跳转到通用的活动错误页面
                default :
                    if (Yii::$app->request->isAjax || Yii::$app->request->isPost) {
                        $this->setError('活动已关闭或不存在');
                    }
                    if($isRedirect){
                        $this->redirect('../activity/error');
                    }else{
                        return false;
                    }
            }
        }
        return true;
    }

    /**
     * 用户授权登陆
     * 内部调用
     */
    private function oauth($callback = '')
    {
        //如果存在登陆信息就返回成功状态
        if ($this->getUserInfo()) {
            return true;
        }
        $wechatOauth = new WechatOauth($this->_wxInfo);
        $accessToken = $wechatOauth->getOauthAccessToken();
        // 授权后拿access_token
        if ($accessToken !== false) {
            //拉取用户信息
            $userInfo = $wechatOauth->getOauthUserinfo($accessToken['access_token'], $accessToken['openid']);
            //创建或修改用户
            $memberService = new MemberService();
            $userInfo += [
                'shop_id' => $this->_wxInfo['shop_id']
            ];

            //连接wifi用户，链接中带shop_sub_id
            if(\Yii::$app->request->get('wifi_shop_sub_id')){
                $userInfo += [
                    'shop_sub_id' => \Yii::$app->request->get('wifi_shop_sub_id')
                ];
            }

            $memberService->authorize($userInfo);
            //缓存用户信息
            $this->setUserSession($accessToken['openid']);
            //如果快过期了，就刷新access_token
            if ($accessToken['expires_in'] < 24 * 3600) {
                $wechatOauth->getOauthRefreshToken($accessToken['access_token']);
            }
            return true;
        } else {
            // 去授权
            if (!$callback) {
                $callback = $this->getUrl();
            }
            $this->redirect($wechatOauth->getOauthRedirect($callback));
        }
        return false;
    }

    /**
     * 处理归属参数 分销员粉丝归属
     * @return array
     */
    public function processAttrParams()
    {
        $mid = getGetParams('mid');
        //推广中心链接
        if(in_array(Yii::$app->requestedRoute, ['fx-member/shop', 'fx-member/card', 'fx/qrcode'])){
            $mid = getGetParams('id');
        }
        if ($mid && in_array(Yii::$app->requestedRoute, FxSetting::$filter)) {

            $params = [
                'mid' => $mid,
                'shop_id' => $this->_shop['id'],
                'user_id' => $this->_userInfo['id'],
            ];
            $member = new Member();
            $member->processAttribution($params);
            if (!is_null($member->getError())) {
                Yii::info(json_encode($params));
                Yii::info($member->getError());
            }
            //刷新用户
            $this->reflashUser();
        }
    }

    /**
     * 获取客户端访问ip
     */
    public function getIp()
    {
        if (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } else if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('REMOTE_ADDR')) {
            $ip = getenv('REMOTE_ADDR');
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $ips = explode(',', $ip);
        if (count($ips) > 1) {
            $ip = $ips[0];
        }
        return $ip;
    }

    /**
     * 获取当前url的jssign
     */
    public function getJsSign($url = '')
    {
        if (!$url) {
            $url = $this->getUrl();
        }
        $wechat = new WechatOauth($this->_wxInfo);
        return $wechat->getJsSign($url);
    }

    /**
     * 获取当前url
     */
    public function getUrl()
    {
        return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    /**
     * 设置用户信息session
     * 内部调用
     */
    private function setUserSession($openid)
    {
        if ($this->getUserInfo()) {
            return true;
        }
        $memberService = new MemberService();
        $params['shop_id'] = $this->_wxInfo['shop_id'];
        $params['open_id'] = $openid;
        $memberService->getByOpenid($params);
        // 接收逻辑层处理结果
        if (!is_null($memberService->getError())) {
            return $this->setError($memberService->getError());
        }
        $userData = $memberService->_data;
        if( !is_null($memberService->getError())){
            $this->setError('获取用户信息失败.');
        }
        $this->setUserInfo($userData);
        $this->setFxMemberInfo($userData['fxMember']);
        $loginParams = [
            'shop_id' => $this->_wxInfo['shop_id'],
            'user_id' => $userData['id'],
            'lastloginip' => $this->getIp(),
            'lastlogintime' => time()
        ];
        $memberService->login($loginParams);
    }

    /**
     * 是否是认证服务号
     * 内部调用
     */
    private function isServiceAccount()
    {
        if ($this->_wxInfo['account_type'] == ThirdParty::TYPE_SERVICE && $this->_wxInfo['account_service'] == ThirdParty::ADVANCED_INTERFACE) {
            return true;
        }
        return false;
    }


    /**
     * 获取微信配置信息
     * 内部调用
     */
    private function getWxInfo()
    {
        if (!is_null($this->_wxInfo)) {
            return $this->_wxInfo;
        }
        //由于前端请求一些类似 messages.min.js.map 空静态资源，所以过滤下
        if(strpos($this->getUrl(),'/ace/') !== false){
            exit();
        }
        $account = '';
        $requestUri = \Yii::$app->request->getUrl();
        $strposBegin = strpos($requestUri, '/');
        if ($strposBegin === false) {
            echo 'No access rights .';
            exit;
        } else {
            $account = substr($requestUri, $strposBegin + 1);
        }
        $strposEnd = strpos($account, '/');
        if ($strposEnd !== false) {
            $account = substr($account, 0, $strposEnd);
        }
        $this->_commonService = new CommonService();
        $serviceParams = array(
            'account' => $account,
            'platform_type' => ThirdParty::TYPE_WX
        );
        if(! $account){
            echo 'No access rights .';
            exit;
        }
        $this->_commonService->getThirdPartyInfoByAccount($serviceParams);
        if (!is_null($this->_commonService->getError())) {
            echo 'No access rights .';
            exit;
        }
        return $this->_commonService->_data;
    }

    /**
     * 设置商家的会员信息
     * 内部调用
     */
    private function setUserInfo($data)
    {
        if (is_null($this->_wxInfo)) {
            return $this->setError();
        }
        $sessionKey = Session::SESSION_KEY_USER.$this->_wxInfo['shop_id'];
        return Session::set($sessionKey,$data);
    }

    /**
     * 设置商家的分销员信息
     * 内部调用
     */
    private function setFxMemberInfo($data)
    {
        if (is_null($this->_wxInfo)) {
            return $this->setError();
        }
        $sessionKey = Session::SESSION_KEY_MEMBER.$this->_wxInfo['shop_id'];
        return Session::set($sessionKey,$data);
    }


    /**
     * 获取商家的会员信息
     * 内部调用
     */
    private function getUserInfo()
    {
        if (is_null($this->_wxInfo)) {
            return $this->setError();
        }
        $sessionKey = Session::SESSION_KEY_USER.$this->_wxInfo['shop_id'];
        $userInfo = Session::get($sessionKey);
        Session::set('CURLOPT_HTTPHEADER',array (
            'X-User-ID:'.$userInfo['id'],
            'X-User-Name:'.$userInfo['nickname'],
            'X-User-Type:1'
        ));
        return $userInfo;

    }

    /**
     * 获取商家的分销员信息
     * 内部调用
     */
    private function getFxMemberInfo()
    {
        if (is_null($this->_wxInfo)) {
            return $this->setError();
        }
        $sessionKey = Session::SESSION_KEY_MEMBER.$this->_wxInfo['shop_id'];
        return Session::get($sessionKey);
    }

    /**
     * 获取微信号对应的商家信息
     * 内部调用
     */
    private function getShop()
    {
        if (is_null($this->_wxInfo)) {
            return $this->setError();
        }
        $serviceParams = [
            'shop_id' => $this->_wxInfo['shop_id'],
        ];
        $shopModel = new Shop();
        $shopModel->get($serviceParams);
        if (!is_null($shopModel->getError())) {
            return $this->setError();
        }
        return $shopModel->_data;
    }

    /**
     * 获取推广员id
     * @return array|mixed|null|string
     */
    public function getMid(){
        if( Yii::$app->request->isPost ) {
            if(Yii::$app->request->post('mid')){
                return Yii::$app->request->post('mid');
            }
            if($this->getPostParams('mid')){
                return $this->getPostParams('mid');
            }
        }else{
            if(\Yii::$app->request->get('mid')){
                return \Yii::$app->request->get('mid');
            }
        }
        return null;
    }

    /**
     * 使用表单校验参数
     * @param $params
     * @param $form
     */
    public function checkForm($params, $form)
    {
        if (!$form->load($params) || !$form->validate()) {
            if (Yii::$app->request->isAjax || Yii::$app->request->isPost) {
                exit('{"errcode":"-4","errmsg":' . json_encode('您提交的数据有误') . '}');
            } else {
                $this->redirect('../error/form');
            }
        }
//        if (Yii::$app->request->isAjax) {
//            $params = Yii::$app->getRequest()->getRawBody();
//        } else {
//            $params = Yii::$app->request->post();
//        }
//        if (!$form->load($params, '') || !$form->validate()) {
//            if (Yii::$app->request->isAjax || Yii::$app->request->isPost) {
//                exit('{"errcode":"-4","errmsg":' . json_encode('您提交的数据有误') . '}');
//            } else {
//                $this->redirect('../error/form');
//            }
//        }
    }

    /**
     * 格式化表单数据
     * @param $form
     */
    public function handleForm($form, $replaceParams = array())
    {
        $formData = $form->toArray();
        self::replaceParams($formData, $replaceParams);
        self::filterNullValue($formData);
        return $formData;
    }

    /**
     * 去除 前台js 传递过来的 null
     */
    public function filterNullValue(&$params){
        foreach($params as $key=>$val){
            if($val === 'null'){
                unset($params[$key]);
            }
        }
    }
    
    /**
     * 把参数合并为逻辑层所需格式
     */
    public function mergeParams(&$params = array(), $mergeKey = 'newKey')
    {
        foreach ($params as $key => $val) {
            if (!is_array($val)) {
                $params[$mergeKey][$key] = $val;
                unset($params[$key]);
            }
        }
    }

    /**
     * 表单校验替换数组键值对
     */
    public static function replaceParams(&$form, $replaceParams)
    {
        if (is_array($replaceParams) && count($replaceParams)) {
            $newFormData = array();
            foreach ($form as $key => $val) {
                if (array_key_exists($key, $replaceParams)) {
                    $newFormData[$replaceParams[$key]] = $val;
                } else {
                    $newFormData[$key] = $val;
                }
            }
            $form = $newFormData;
        }
    }

    /**
     * 输出访问信息
     */
    public function setResult($errmsg = null, $is_callback = true)
    {
        $is_callback && $this->getCallback($errmsg);
        if (Yii::$app->request->isAjax) {
            // 设置成功状态为 0
            $errcode = 0;
            exit('{"errcode":' . $errcode . ',"errmsg":' . json_encode($errmsg) . '}');
        }
        if (Yii::$app->request->isPost) {
            // 设置成功状态为 0
            $errcode = 0;
            exit('{"errcode":' . $errcode . ',"errmsg":' . json_encode($errmsg) . '}');
        }
    }

    /**
     * 输出错误信息
     */
    public function setError($params = array(),$redirect = null)
    {
        // 兼容没有 errmsg 键 的变量错误信息
        if (!is_null($params)) {
            if (is_array($params)) {
                if (!isset($params['errmsg'])) {
                    $params = [
                        'errmsg' => $params
                    ];
                }
            } else {
                $params = [
                    'errmsg' => $params
                ];
            }
        }
        if (Yii::$app->request->isAjax || Yii::$app->request->isPost) {
            // 访问接口类型出错
            $errcode = isset($params['errcode']) ? $params['errcode'] : -1;
            $errmsg = isset($params['errmsg']) ? $params['errmsg'] : '服务器忙，请稍后再尝试';
            exit('{"errcode":' . $errcode . ',"errmsg":' . json_encode($errmsg) . '}');
        } else {
            if( ! $redirect){
                $this->redirect('../mall/error');
            }else{
                $this->redirect($redirect);
            }
        }
    }

    /**
     * 参数格式化
     */
    protected function handleParams($params = [])
    {
        if(count($params)){
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
