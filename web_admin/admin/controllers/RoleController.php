<?php
/**
 * Author: LiuPing
 * Date: 2015/08/15
 * Time: 14:47
 */

namespace admin\controllers;

use common\forms\GeneralForm;
use common\forms\GeneralSafeForm;
use common\forms\role\AddAjaxForm;
use common\forms\role\EditAjaxForm;
use common\forms\role\SaveRoleFunctionAjaxForm;
use common\models\Role;
use Yii;

class RoleController extends BaseController
{

    protected $roleModel;

    function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function init()
    {
        $this->roleModel = new Role();
    }

    /**
     * 角色列表
     */
    public function actionList()
    {
        if($this->getShopSubId()){
            return $this->render('/staff/role-list');
        }
        return $this->render('list');
    }

    /**
     * 终端店角色列表
     */
    public function actionListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }

        if(Yii::$app->request->post('id') !=null)
        {
            //添加员工的下拉框选择
            $form = new GeneralSafeForm();
            $this->checkForm(["GeneralSafeForm" => Yii::$app->request->post()], $form);
            $replaceParams = [
                'id' => 'shop_sub_id',
            ];
            $serviceParams = $this->handleForm($form,$replaceParams);
            $serviceParams +=[
                'system' => Role::SYSTEM_SHOP,
                'shop_id' => $this->_shop['id']
            ];
        }else {
            //角色列表
            $serviceParams = [
                'doFilter' => ['is_default' => Role::IS_DEFAULT_TRUE],
                'shop_id' => $this->_shop['id']
            ];
            if($this->getShopSubId()){
                $serviceParams += ['system' => Role::SYSTEM_SHOP];
            }else{
                $serviceParams += ['system' => Role::SYSTEM_ADMIN];
            }
            $this->getPageInfo($serviceParams);
        }
        $this->roleModel->find($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->roleModel->getError())) {
            return $this->setError($this->roleModel->getError());
        }
        foreach($this->roleModel->_data['data'] as $key=>$val){
            if($val['is_default'] == 1){
                array_splice($this->roleModel->_data['data'], $key, 1);
            }
        }
        $this->setResult($this->roleModel->_data);
    }

    /**
     * 添加角色
     */
    public function actionAdd()
    {

      $serviceParams = [
        'shop_id' => $this->_shop['id'],
        'system' => 1,
      ];
      if($this->getShopSubId()){
        $serviceParams['system'] = 2;
      }elseif($this->getAgentId()){
        $serviceParams['system'] = 3;
      }
      $this->roleModel->findMenu($serviceParams);
      $menu = $this->roleModel->_data; //获取商家权限菜单
      if (!is_null($this->roleModel->getError())) {
        return $this->setError($this->roleModel->getError());
      }
      $newMenu = [];
      $i = 1;
      foreach($menu as $val){
        $newMenu[$i] = $val;
        $i++;
      }
      if(is_array($newMenu) && count($newMenu)){
        foreach($newMenu as $key=>$val){
            $newMenu[$key]['checked'] = true;
        }
      }
      return $this->render('add', ['menu' => $newMenu]);
    }

    /**
     * ajax 角色添加
     */
    public function actionAddAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new AddAjaxForm();
        $this->checkForm(["AddAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        if($this->getShopSubId()){
            $serviceParams += [
                'shop_sub_id' => $this->getShopSubId(),
                'system' => Role::SYSTEM_SHOP, //所属系统，Admin后台
            ];
        }else{
            $serviceParams += [
                'system' => Role::SYSTEM_ADMIN, //所属系统，Admin后台
            ];
        }
        //调用model层
        $this->roleModel->create($serviceParams);
        //接收model层处理结果
        $model = $this->roleModel->_data;
        if (!is_null($this->roleModel->getError()) || empty($model)) {
            return $this->setError($this->roleModel->getError());
        }
        $this->setResult([$model]);
    }

    /**
     * 编辑角色
     */
    public function actionEdit()
    {
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->get()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->roleModel->get($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->roleModel->getError())) {
            return $this->setError($this->roleModel->getError());
        }
        $model = $this->roleModel->_data;
      $serviceParams += [
        'shop_id' => $this->_shop['id'],
        'system' => 1,
        'role_id' => $serviceParams['id'],
      ];
      $this->roleModel->findRoleMenu($serviceParams);
      $roleMenu = $this->roleModel->_data; //获取商家权限菜单
      if (!is_null($this->roleModel->getError())) {
        return $this->setError($this->roleModel->getError());
      }
      if($this->getShopSubId()){
        $serviceParams['system'] = 2;
      }elseif($this->getAgentId()){
        $serviceParams['system'] = 3;
      }
      $this->roleModel->findMenu($serviceParams);
      $menu = $this->roleModel->_data; //获取商家权限菜单
      if (!is_null($this->roleModel->getError())) {
        return $this->setError($this->roleModel->getError());
      }
      $newMenu = [];
      $i = 1;
      foreach($menu as $val){
        $newMenu[$i] = $val;
        $i++;
      }
      if(is_array($roleMenu) && count($roleMenu)){
        $newRoleMenu = [];
        foreach($roleMenu as $val){
          $newRoleMenu[$val['auth_function_menu_id']] = $val;
        }
        foreach($newMenu as $key=>$val){
          if(array_key_exists($val['id'],$newRoleMenu)){
            $newMenu[$key]['checked'] = true;
          }
        }
      }
      return $this->render('edit', ['model' => $model,'menu' => $newMenu]);
    }

    /**
     * ajax 角色编辑
     */
    public function actionEditAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new EditAjaxForm();
        $this->checkForm(["EditAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'system' => Role::SYSTEM_ADMIN, //所属系统，Admin后台
            'shop_id' => $this->_shop['id']
        ];
        //调用model层
        $this->roleModel->update($serviceParams);
        //接收model层处理结果
        $model = $this->roleModel->_data;
        if (!is_null($this->roleModel->getError()) || empty($model)) {
            return $this->setError($this->roleModel->getError());
        }
        $this->setResult([$model]);
    }

    /**
     * ajax 角色添加
     */
    public function actionDeleteAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        //调用model层
        $this->roleModel->delete($serviceParams);
        //接收model层处理结果
        $model = $this->roleModel->_data;
        if (!is_null($this->roleModel->getError())) {
            return $this->setError($this->roleModel->getError());
        }
        $this->setResult([$model]);
    }

    /**
     *权限分配
     */
    public function actionPermission()
    {
        // form处理
        $form = new GeneralForm();
        $get = Yii::$app->request->get();
        $this->checkForm(["GeneralForm" => $get], $form);
        $serviceParams = $this->handleForm($form, ['id' => 'role_id']);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'system' => 1,
        ];
        if($this->getShopSubId()){
            $serviceParams['system'] = 2;
        }elseif($this->getAgentId()){
            $serviceParams['system'] = 3;
        }
        $this->roleModel->findMenu($serviceParams);
        $menu = $this->roleModel->_data; //获取商家权限菜单
        if (!is_null($this->roleModel->getError())) {
            return $this->setError($this->roleModel->getError());
        }
        $this->roleModel->findRoleMenu($serviceParams);
        $roleMenu = $this->roleModel->_data; //获取商家权限菜单
        if (!is_null($this->roleModel->getError())) {
            return $this->setError($this->roleModel->getError());
        }
        $newMenu = [];
        $i = 1;
        foreach($menu as $val){
            $newMenu[$i] = $val;
            $i++;
        }
        if(is_array($roleMenu) && count($roleMenu)){
            $newRoleMenu = [];
            foreach($roleMenu as $val){
                $newRoleMenu[$val['auth_function_menu_id']] = $val;
            }
            foreach($newMenu as $key=>$val){
                if(array_key_exists($val['id'],$newRoleMenu)){
                    $newMenu[$key]['checked'] = true;
                }
            }
        }
        return $this->render('permission', ['auth_role_id' => $get['id'], 'menu' => $newMenu]);
    }

    /**
     * 获取权限权限列表以及权限列表
     */
    private function _findFunctionMenuWithFunction($model = [])
    {
        $serviceParams = [
            'system' => Role::SYSTEM_ADMIN,
            //'pid' => 0,
            'level' => 4
        ];
        $this->roleModel->findFunctionMenuWithFunction($serviceParams);
        if (!is_null($this->roleModel->getError())) {
            return $this->setError($this->roleModel->getError());
        }
        $func_ids = [];
        if (is_array($model) && count($model) && $this->roleModel->_data) {
            foreach ($model as $val) {
                $func_ids[] = $val['func_id'];
            }
            /*foreach ($this->roleModel->_data as &$val) {
                foreach ($val['sub'] as &$sub_val) {
                    foreach ($sub_val['sub'] as &$sub_v) {
                        $sub_v['isAllCheck'] = true; //初始化全选
                        foreach ($sub_v['rAuthFunctionAuthFunctionMenus'] as &$fun_val) {
                            if (in_array($fun_val['auth_function_id'], $func_ids)) {
                                $fun_val['isCheck'] = true; //判断是否勾选
                            } else {
                                $sub_v['isAllCheck'] = false;//初始化全选
                            }
                        }
                    }

                }
                //$this->_dealData($val, $func_ids);
            }*/

        }
        foreach ($this->roleModel->_data as &$val) {
            $this->_dealData($val, $func_ids);
        }
        return ['func_ids' => $func_ids, 'funcList' => $this->roleModel->_data];
    }

    private function _dealData(&$data, $func_ids){
        if(isset($data['sub']) && is_array($data['sub'])){
            foreach ($data['sub'] as &$sub_val) {
                $sub_val['isAllCheck'] = true; //初始化全选
                $this->_dealData($sub_val, $func_ids);
            }
            $data['is_function_menu'] = false;
        }else{
            $data['is_function_menu'] = true;
            foreach ($data['rAuthFunctionAuthFunctionMenus'] as &$fun_val) {
                if (in_array($fun_val['auth_function_id'], $func_ids)) {
                    $fun_val['isCheck'] = true; //判断是否勾选
                } else {
                    $data['isAllCheck'] = false;//初始化全选
                }
            }
        }
    }

    /**
     * 分配角色功能权限
     */
    public function actionSaveRoleFunctionAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new SaveRoleFunctionAjaxForm();
        $this->checkForm(["SaveRoleFunctionAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        //调用model层
        $this->roleModel->saveRoleFunction($serviceParams);
        if (!is_null($this->roleModel->getError())) {
            return $this->setError($this->roleModel->getError());
        }
        $this->setResult([$this->roleModel->_data]);
    }
}