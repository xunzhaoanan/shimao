<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 13:50
 */


namespace admin\controllers;

use common\forms\activity\ImageTxtAddForm;
use common\forms\activity\ListAjaxForm;
use common\forms\GeneralForm;
use common\forms\secondkill\AddAjaxForm;
use common\forms\secondkill\EditAjaxForm;
use common\forms\secondkill\SeckillGoodsAddAjaxForm;
use common\forms\secondkill\SeckillGoodsUpdateAjaxForm;
use common\forms\secondkill\SecondKillEditForm;
use common\models\Activity;
use common\models\NewsPushConfig;
use common\models\ShareConfig;
use common\services\activity\SecondKillService;
use Yii;
use yii\base\UserException;
use yii\web\NotFoundHttpException;


class SecondKillController extends BaseController
{

    protected $secondKillService;

    function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->secondKillService = new SecondKillService();
    }

    /**
     * 秒杀活动列表
     */
    public function actionList()
    {
        return $this->render('list');
    }

    /**
     * 添加秒杀活动
     * 跳转活动添加统一视图 '/activity/add',并给视图传递添加方法请求地址'addUrl'
     */
    public function actionAdd()
    {
        return $this->render('/activity/add', [
            'title' => '添加秒杀活动',
            'addUrl' => '/second-kill/add-ajax',
            'leftMenuLevel' => 'ea',//左侧导航级别
            'news' => NewsPushConfig::$secondKill,
            'redirectUrl' => '/second-kill/edit'
        ]);
    }

    /**
     * 查看/编辑活动  详细信息
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
        $this->secondKillService->secondKillGet($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->secondKillService->getError())) {
            return $this->setError($this->secondKillService->getError());
        }
        $model = $this->secondKillService->_data;
        return $this->render('edit', ['model' => $model]);
    }

    /**
     * 查看/编辑活动  图文信息
     */
    public function actionEditNews()
    {
        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->get()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->secondKillService->secondKillGet($serviceParams);
        // 接收逻辑层处理结果
        $model = $this->secondKillService->_data;
        if (!is_null($this->secondKillService->getError()) || empty($model)) {
            return $this->setError($this->secondKillService->getError());
        }
        return $this->render('/activity/edit',
            [
                'title' => '编辑秒杀活动',
                'model' => $model,
                'leftMenuLevel' => 'ea',
                'editUrl' => '/second-kill/edit-ajax',
                'redirectUrl' => '/second-kill/edit?id=' . $model['activity']['id'],
                'type' => 'secondKill'
            ]);
    }

    /**
     * ajax 活动列表分页
     */
    public function actionListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new ListAjaxForm();
        $this->checkForm(["ListAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form, ['_name' => 'name']);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($serviceParams);
        $this->secondKillService->secondKillFind($serviceParams);
        $model = $this->secondKillService->_data;
        // 接收逻辑层处理结果
        if (!is_null($this->secondKillService->getError())) {
            return $this->setError($this->secondKillService->getError());
        }
        //秒杀关联商品数
        $this->_deal($model);
        $this->setResult($model);
    }
    /**
     * 秒杀关联商品个数
     * @param $data
     * @return array
     */
    private function _deal(&$data)
    {
        foreach ($data['data'] as &$val) {
            $val['seckillGoodsCount'] = isset($val['secondKill']['seckillGoods']) && is_array($val['secondKill']['seckillGoods'])
                ? count($val['secondKill']['seckillGoods']) : 0;
        }
    }

    /**
     * 添加秒杀活动
     */
    public function actionAddAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理 使用activity下的图文验证的form验证
        $form = new AddAjaxForm();
        $this->checkForm(["AddAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);//pr($serviceParams);
        //添加商家id
        $serviceParams['activity'] = [
            'shop_id' => $this->_shop['id']
        ];
        $this->secondKillService->secondKillCreate($serviceParams);
        // 接收逻辑层处理结果
        $model = $this->secondKillService->_data;
        if (!is_null($this->secondKillService->getError()) || empty($model)) {
            return $this->setError($this->secondKillService->getError());
        }
        $this->setResult([$model, 'id' => $model['activity']['id']]);
    }

    /**
     * 编辑秒杀活动
     */
    public function actionEditAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $post = Yii::$app->request->post();
        if (isset($post['activitytype'])) {
            $post['secondKill'] = $post['activitytype'];
        }
        // form处理
        $form = new EditAjaxForm();
        $this->checkForm(["EditAjaxForm" => $post], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams['activity'] += [
            'shop_id' => $this->_shop['id']
        ];
        $this->secondKillService->secondKillUpdate($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->secondKillService->getError())) {
            return $this->setError($this->secondKillService->getError());
        }
        $model = $this->secondKillService->_data;
        $this->setResult([$model, 'id' => $model['activity']['id']]);
    }

    /**
     * 开启秒杀活动
     */
    public function actionOpenAjax()
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
        $this->secondKillService->secondKillOpen($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->secondKillService->getError())) {
            return $this->setError($this->secondKillService->getError());
        }
        $this->setResult($this->secondKillService->_data);
    }

    /**
     * 关闭秒杀活动
     */
    public function actionCloseAjax()
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
        $this->secondKillService->secondKillClose($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->secondKillService->getError())) {
            return $this->setError($this->secondKillService->getError());
        }
        $this->setResult($this->secondKillService->_data);
    }

    /**
     * 删除秒杀活动
     */
    public function actionDelAjax()
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
        $this->secondKillService->secondKillDel($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->secondKillService->getError())) {
            return $this->setError($this->secondKillService->getError());
        }
        $this->setResult($this->secondKillService->_data);
    }

    /**
     * 添加秒杀商品
     */
    public function actionSeckillGoodsAddAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new SeckillGoodsAddAjaxForm();
        $this->checkForm(["SeckillGoodsAddAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->secondKillService->seckillGoodsCreate($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->secondKillService->getError())) {
            return $this->setError($this->secondKillService->getError());
        }
        $this->setResult($this->secondKillService->_data);
    }

    /**
     * 修改关联商品
     */
    public function actionSeckillGoodsUpdateAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new SeckillGoodsUpdateAjaxForm();
        $this->checkForm(["SeckillGoodsUpdateAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->secondKillService->seckillGoodsUpdate($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->secondKillService->getError())) {
            return $this->setError($this->secondKillService->getError());
        }
        $this->setResult($this->secondKillService->_data);
    }

    /**
     * 去除关联商品
     */
    public function actionSeckillGoodsDelAjax()
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
        $this->secondKillService->seckillGoodsDel($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->secondKillService->getError())) {
            return $this->setError($this->secondKillService->getError());
        }
        $this->setResult($this->secondKillService->_data);
    }

    /**
     * 获取秒杀商品列表
     */
    public function actionSeckillGoodsListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form, ['id' => 'second_kill_id']);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];

        $this->getPageInfo($serviceParams);
        $this->secondKillService->seckillGoodsFind($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->secondKillService->getError())) {
            return $this->setError($this->secondKillService->getError());
        }
        $this->setResult($this->secondKillService->_data);
    }
}