<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */

namespace common\newcontrollers;

use common\helpers\BaseApiHelper;
use common\helpers\CommonFunctionHelper;
use common\helpers\JsApiCodeHelper;
use common\helpers\JsApiHelper;
use common\helpers\YiiHelper;
use Yii;
use yii\base\Controller;

/**
 * Class BaseForm
 * @package wsh\shanghu\forms
 */
class BaseController extends Controller
{

    protected $_sortDesc;
    protected $_sortAsc;
    //当前运行的类
    protected $_class;
    //当前运行类的方法
    protected $_action;

    public function __construct($id, $module, $config)
    {
        parent::__construct($id, $module, $config);
        $this->_initSystem();
    }

    /**
     * 跳转url
     */
    function redirect($url = '/')
    {
        CommonFunctionHelper::redirect($url);
    }

    /**
     * 初始化项目数据
     */
    private function _initSystem(){
        $this->_sortDesc = BaseApiHelper::PARAMS_SORT_DESC;
        $this->_sortAsc = BaseApiHelper::PARAMS_SORT_ASC;
        $this->_class = $this->id;
        $this->_action = substr($this->module->requestedRoute,strpos($this->module->requestedRoute,'/')+1);
    }

    /**
     * 使用form校验js传的参数，并返回form处理后的结果
     */
    protected function handleForm($params, $form, $pageLoad = false)
    {
        if ( ! $form->load($params)) {
            $this->setError('出错了~~~~',JsApiCodeHelper::CODE_ERROR_PARAMS);
        }
        if ( ! $form->validate()) {
//            if ($form->errors) {
//                pr($form->errors);
//            }
            $this->setError('您提交的数据有误',JsApiCodeHelper::CODE_ERROR_PARAMS);
        }
        if( ! is_array($form)){
            $form = $form->toArray();
        }
        if($pageLoad) $this->loadPageParams($form);
        return $form;
    }

    /**
     * 使用dto格式化baseapi返回的数据，并返回dto处理后的结果
     */
    protected function handleDto($data, $dto)
    {
        return $dto->format($data,$dto->rules());
    }

    /**
     * 设置查询排序
     */
    protected function setSort(&$params,$sort){
        if(is_array($sort) && count($sort)){
            foreach($sort as $key=>$val){
                if($val != BaseApiHelper::PARAMS_SORT_DESC){
                    $sort[$key] = BaseApiHelper::PARAMS_SORT_ASC ;
                }
            }
            $params[BaseApiHelper::PARAMS_SORT] = $sort;
        }
    }

    /**
     * 得到分页参数
     */
    protected function loadPageParams(&$params){
        $page = YiiHelper::getRequest()->post(JsApiHelper::PARAMS_PAGE);
        $count = YiiHelper::getRequest()->post(JsApiHelper::PARAMS_COUNT);
        $params[BaseApiHelper::PARAMS_PAGE] = $page && intval($page) > 0 ? intval($page) - 1 : 0 ;
        $params[BaseApiHelper::PARAMS_COUNT] = $count && intval($count) < 1000 ? intval($count) : 20 ;
    }

    /**
     * 设置错误信息
     */
    protected function setError($errMsg,$errCode = '-2'){
        JsApiHelper::setError($errMsg,$errCode);
    }

    /**
     * 输出访问结果
     */
    protected function setResult($errmsg = 'ok'){
        JsApiHelper::setResult($errmsg);
    }

}
