<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */

namespace admin\controllers;

use common\cache\Session;
use common\models\Login;
use common\models\Member;
use common\models\Permission;
use common\models\Role;
use common\models\Shop;
use common\models\Terminal;
use Yii;
use common\models\ThirdParty;
use common\services\CommonService;
use yii\base\Controller;
use yii\log\Logger;

/**
 * Class BaseForm
 * @package wsh\admin\forms
 */
class BaseController extends Controller
{
    //不校验前端 csrf 攻击
    public $enableCsrfValidation = false;

    ## 登录信息 ##
    public $_shop = NULL; //商家信息
    public $_shopManager = NULL; //管理员专有属性
    public $_shopStaff = NULL; //员工专有属性
    public $_wxInfo = NULL; //微信配置
    public $_commonService;
    public $_shopSub = NULL; //店铺主表信息
    public $_permission = NULL; //权限
    public $_noAccessCode = null;

    public function __construct($id, $module, $config)
    {
        parent::__construct($id, $module, $config);
        $this->_commonService = new CommonService();
        $this->_noAccessCode = '-505';
        //开发阶段，暂时去除登录
        if(is_null(Session::get(Session::SESSION_KEY_MANAGER))){
            //判断登录
            if (Yii::$app->request->isGet) {
                $this->goLogin();
            }else{
                exit('{"errcode":-1,"errmsg":' . json_encode('页面已过期，请刷新重试') . '}');
            }
        } else {
            $this->_shopManager = Session::get(Session::SESSION_KEY_MANAGER);
            Session::set('CURLOPT_HTTPHEADER',array (
                'X-User-ID:'.$this->_shopManager['id'],
                'X-User-Name:'.$this->_shopManager['name'],
                'X-User-Type:4'
            ));
            $shopModel = new Shop();
            $shopModel->get(['shop_id'=>$this->_shopManager['shop_id']]);
            $this->_shop = $shopModel->_data;
            $this->checkOverdue();
            $this->_shopSub = Session::get(Session::SESSION_KEY_SHOPSUB);
            $this->_wxInfo = $this->getWxInfo();
            $this->_permission = $this->getPermission();
            $this->_shopStaff = Session::get(Session::SESSION_KEY_STAFF);
        }

    }

    /**
     * 检查商家合同
     */
    private function checkOverdue(){
        if(time() > strtotime($this->_shop['contract_end']) && $this->module->requestedRoute != 'shop/overdue'){
            $this->redirect('/shop/overdue');
        }
    }

    /**
     * 跳转到登陆页面
     */
    public function goLogin(){
        $host = $_SERVER['HTTP_HOST'];
        //线上环境，并且不是登陆页面
        if(strpos($host,Login::ONLINE_HOST_KEY) && strlen($_SERVER['REQUEST_URI']) > 1){
            $this->redirect(Login::ONLINE_LOGIN_URL);
        }
        //测试及开发环境
        $this->redirect('/login/index');
    }

    public function getPermission(){
        return Session::get(Session::SESSION_KEY_PERMISSION);
    }

    public function beforeAction($action){
        Yii::info(['url'=>Yii::$app->request->url,'params'=>json_decode(Yii::$app->request->rawBody, true)],'ParamsIn');
        if($this->_shopManager['is_default'] == 1){
            return true;
        }
        if( ! $this->checkPermission($this->id,$this->action->id)){
            //临时处理文件导入(fx/import-csv)
            if($this->id == 'fx' && $this->action->id == 'import-csv'){
                $this->redirect(array('/fx/import?code=1004'));
            }
            noAccess($this->_noAccessCode);
        }
        return true;
    }

    /**
     * 检查权限
     */
    public function checkPermission($class,$function){
        //开发阶段，关闭权限控制
        if(CODE_RUNTIME == CODE_RUNTIME_LOCAL || CODE_RUNTIME == CODE_RUNTIME_DEV){
            return true;
        }
        //忽略的权限
        $ignore = Permission::$ignoreListByadmin;
        if(array_key_exists($class,$ignore)){
            if( ! is_array($ignore[$class])){
                return true;
            }else if(in_array($function,$ignore[$class])){
                return true;
            }
        }
        //角色的权限
        if(in_array(Yii::$app->requestedRoute,$this->_permission)){
            return true;
        }
        //特殊通用权限处理
        $specialIgnore = Permission::$specialIgnoreListByadmin;
        if(in_array(Yii::$app->requestedRoute,$specialIgnore)){
            return true;
        }
        return false;
    }

    /**
     * 跳转url
     */
    public function redirect($url = '/')
    {
        if (is_array($url)) {
            $url = $url[0];
        }
        Header('Location: ' . $url);
        exit;
    }

    /**
     * 得到分页参数
     */
    public function getPageInfo(&$params, $defaultPage = [])
    {
        //是否禁止自动获取 agent_id 和 terminal_id
        if( ! isset($params['auto_get_params'])){
            //赋值默认值
            $params['agent_id'] = $this->getAgentId();
            $params['staff_id'] = $this->getStaffId();
            $params['shop_sub_id'] = $this->getShopSubId();
            //兼容fx/member-list-ajax
            $params['storeId'] = isset($params['storeId']) ? $params['storeId'] : $this->getShopSubId();
            $params['member_id'] = $this->getMemberId();
            $params['createStart'] = $this->getCreateStart('createStart');
            $params['createEnd'] = $this->getCreateEnd('createEnd');
        }
        $page = \Yii::$app->request->post('_page');
        $count = \Yii::$app->request->post('_page_size');
        $defaultPage['page'] = isset($defaultPage['page']) ? $defaultPage['page'] : 0;
        $defaultPage['count'] = isset($defaultPage['count']) ? $defaultPage['count'] : 20;
        $params['page'] = isset($page) ? intval($page - 1) : $defaultPage['page'];
        $params['count'] = isset($count) ? $count : $defaultPage['count'];
        $params['count'] = $params['count'] > 1000 ? 1000 : $params['count'];
        if (!isset($params['sortStr'])) {
            $params['sortStr'] = ['id' => 'desc'];
        }
    }

    /**
     * 获取店长的id(null)或者员工id
     */
    public function getStaffId(){
        if( Yii::$app->request->isPost ) {
            if($this->getPostParams('staff_id')){
                return $this->getPostParams('staff_id');
            }
            if(Yii::$app->request->post('staff_id')){
                return Yii::$app->request->post('staff_id');
            }
        }else{
            if(\Yii::$app->request->get('staff_id')){
                return \Yii::$app->request->get('staff_id');
            }
        }
        return null;
    }

    /**
     * 得到shop_sub_id
     */
    public function getShopSubType($id=null){
            if($id !=null)
            {
                $params = array(
                    'shop_id' => $this->_shop['id'],
                    'shop_sub_id' => $id
                );
                $shop = new Terminal();
                $shop->get($params);
                if (!is_null($shop->_data)) {
                    return $shop->_data['shop_type'];
                } else {
                    return '';
                }
            }
            if($this->getPostParams('terminal_id')){
                $params = array(
                    'shop_id' => $this->_shop['id'],
                    'shop_sub_id' => $this->getPostParams('terminal_id')
                );
                $shop = new Terminal();
                $shop->get($params);
                if (!is_null($shop->_data)) {
                    return $shop->_data['shop_type'];
                } else {
                    return '';
                }
            }

        return null;
    }

    /**
     * 获取数据统计需要参数
     */
    public function getStatisticsParams(&$params){
        $params += [
            'shop_sub_id' => $this->getShopSubId(),
            'staff_id' => $this->getStaffId()
        ];
        $params['agent_ids'] = $this->getAgentIds();
    }

    /**
     * 获取代理商id
     */
    public function getAgentIds(){
        if( Yii::$app->request->isPost ) {
            if($this->getPostParams('agent_id')){
                return $this->getPostParams('agent_id');
            }
            if(Yii::$app->request->post('agent_id')){
                return Yii::$app->request->post('agent_id');
            }
        }else{
            if(\Yii::$app->request->get('agent_id')){
                return \Yii::$app->request->get('agent_id');
            }
        }
        return null;
    }

    /**
     * 得到开始时间
     */
    public function getCreateStart(){
        if( Yii::$app->request->isPost ) {
            if(Yii::$app->request->post('createStart')){
                return Yii::$app->request->post('createStart');
            }
            if($this->getPostParams('createStart')){
                return $this->getPostParams('createStart');
            }
        }else{
            if(\Yii::$app->request->get('createStart')){
                return \Yii::$app->request->get('createStart');
            }
        }
        return null;
    }

    /**
     * 得到结束时间
     */
    public function getCreateEnd(){
        if( Yii::$app->request->isPost ) {
            if(Yii::$app->request->post('createEnd')){
                return Yii::$app->request->post('createEnd');
            }
            if($this->getPostParams('createEnd')){
                return $this->getPostParams('createEnd');
            }
        }else{
            if(\Yii::$app->request->get('createEnd')){
                return \Yii::$app->request->get('createEnd');
            }
        }
        return null;
    }

    /**
     * 得到shop_sub_id
     */
    public function getShopSubId(){
        if( Yii::$app->request->isPost ) {
            if(\Yii::$app->request->post('terminal_id')){
                return \Yii::$app->request->post('terminal_id');
            }
            if($this->getPostParams('terminal_id')){
                return $this->getPostParams('terminal_id');
            }
            if(Yii::$app->request->post('terminal_id')){
                return Yii::$app->request->post('terminal_id');
            }
        }else{
            if(\Yii::$app->request->get('terminal_id')){
                return \Yii::$app->request->get('terminal_id');
            }
            if($this->getPostParams('terminal_id')){
                return $this->getPostParams('terminal_id');
            }
        }
        return null;
    }

    /**
     * 得到agent_id
     */
    public function getAgentId(){
        if( Yii::$app->request->isPost ) {
            if(\Yii::$app->request->post('agent_id')){
                return \Yii::$app->request->post('agent_id');
            }
            if($this->getPostParams('agent_id')){
                return $this->getPostParams('agent_id');
            }
            if(Yii::$app->request->post('agent_id')){
                return Yii::$app->request->post('agent_id');
            }
        }else{
            if(\Yii::$app->request->get('agent_id')){
                return \Yii::$app->request->get('agent_id');
            }
        }
        return null;
    }


    /**
     * 得到推广员ID
     */
    public function getMemberId(){
        if( Yii::$app->request->isPost ) {
            if($this->getPostParams('member_id')){
                return $this->getPostParams('member_id');
            }
            if(Yii::$app->request->post('member_id')){
                return Yii::$app->request->post('member_id');
            }
        }else{
            if(\Yii::$app->request->get('member_id')){
                return \Yii::$app->request->get('member_id');
            }
        }
        return null;
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
     * 字符串转义
     */
    public function addslash($val, $force = false)
    {

        if (!get_magic_quotes_gpc() || $force) {
            if (is_array($val)) {
                foreach ($val as $key => $value) {
                    if (is_array($value)) {
                        $val[$key] = self::addslash($value, $force);
                    } else {
                        $val[$key] = addslashes($value);
                    }
                }
            } else {
                $val = addslashes($val);
            }
        }
        return $val;
    }

    /**
     * 获取微信配置信息
     * 内部调用
     */
    private function getWxInfo()
    {
        $params = array(
            'shop_id' => $this->_shop['id'],
            'platform_type' => ThirdParty::TYPE_WX
        );
        $this->_commonService->getThirdPartyInfo($params);
        if (!is_null($this->_commonService->getError())) {
            return $this->setError();
        }
        Session::set(Session::SESSION_KEY_WXINFO, $this->_commonService->_data);
        return $this->_commonService->_data;
    }

    /**
     * 使用表单校验参数
     * @throws BusinessException
     */
    public function checkForm($params = null, $form)
    {
        $flag = false;
        if (!$params) {
            if (Yii::$app->request->isAjax) {
                $params = Yii::$app->getRequest()->getRawBody();
                if (!is_array($params)) {
                    $params = Yii::$app->request->post();
                }
            } elseif (Yii::$app->request->isPost) {
                $params = Yii::$app->request->post();
            } else {
                $params = Yii::$app->request->get();
            }
            $flag = true;
            //不传任何参数时使用以下设置
            if(!$params){
                $formName = array_pop(explode("\\",get_class($form)));
                $params = [$formName=>null];
            }
        }
        $loadRet = $flag ? $form->load($params, '') : $form->load($params);
        if (!$loadRet || !$form->validate()) {
            if (Yii::$app->request->isAjax || Yii::$app->request->isPost) {
                Yii::getLogger()->log(['errorkey' => get_class($form), 'errorvalue' => $form->errors], Logger::LEVEL_ERROR);
                exit('{"errcode":"-4","errmsg":' . json_encode('您提交的数据有误') . '}');
            } else {
                $this->redirect('../shop/error');
            }
        }

    }

    /**
     * 格式化表单数据
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
    public function setResult($errmsg = null)
    {
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
    public function setError($params = null)
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
            Yii::error(json_encode($errmsg));
            exit('{"errcode":"' . $errcode . '","errmsg":' . json_encode($errmsg) . '}');
        } else {
            // 访问接口类型出错
            Yii::error(json_encode($params));
            $this->redirect('/shop/error');
        }
    }

    /**
     * 根据微信用户id获取openid
     * 参数：uid、shop_id
     */
    public function getOpenidByUid($params)
    {
        $memberModel = new Member();
        $memberModel->get($params);
        if (!is_null($memberModel->_data)) {
            return $memberModel->_data['wxUsers']['open_id'];
        } else {
            return '';
        }
    }

}
