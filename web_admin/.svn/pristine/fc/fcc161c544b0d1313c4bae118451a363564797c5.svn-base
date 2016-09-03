<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 13:50
 */


namespace admin\controllers;

use common\forms\activity\EditNewsAjaxForm;
use common\forms\activity\ListAjaxForm;
use common\forms\GeneralForm;
use common\forms\redpack\AddAjaxForm;
use common\forms\redpack\EditAjaxForm;
use common\forms\redpack\FindLogListAjaxForm;
use common\models\Activity;
use common\models\NewsPushConfig;
use common\models\Redpack;
use common\models\RuleConfig;
use common\models\ShareConfig;
use common\services\activity\RedpackService;
use Yii;
use yii\base\UserException;
use yii\web\NotFoundHttpException;


class RedpackController extends BaseController
{

    protected $redpackService;

    function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->redpackService = new RedpackService();
    }

    /**
     * 添加活动
     */
    public function actionAdd()
    {
        return $this->render('add', [
            'shareMessage' => ShareConfig::$groupRedpack,
            'news' => NewsPushConfig::$grouppack,
            'rule' => RuleConfig::$groupRedpack
        ]);
    }

    /**
     * 查看/编辑活动
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
        $this->redpackService->get($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->redpackService->getError())) {
            return $this->setError($this->redpackService->getError());
        }
        $model = $this->redpackService->_data;
        return $this->render('edit', ['model' => $model]);
    }

    /**
     * 活动列表
     */
    public function actionList()
    {
        return $this->render('list');
    }

    /**
     * 活动列表分页
     */
    public function actionListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new ListAjaxForm();
        $this->checkForm(["ListAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form, ['_name' => 'name']);
        $countFlag = Yii::$app->request->post('countFlag');
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'share_type' => Yii::$app->request->post('is_display') == true ? Activity::SHARE_TYPE_NORMAL : null, //是否显示惊喜列表里
            'countFlag' => empty($countFlag) ? false : true //返回派发统计信息
        ];
        $this->getPageInfo($serviceParams);
        $this->redpackService->find($serviceParams);
        $model = $this->redpackService->_data;
        // 接收逻辑层处理结果
        if (!is_null($this->redpackService->getError())) {
            return $this->setError($this->redpackService->getError());
        }
        $this->setResult($model);
    }

    /**
     * 添加活动
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
        $serviceParams['activity'] += [
            'shop_id' => $this->_shop['id'],

        ];
        $this->redpackService->create($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->redpackService->getError())) {
            return $this->setError($this->redpackService->getError());
        }
        $this->setResult($this->redpackService->_data);
    }

    /**
     * 编辑活动
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
        $serviceParams['activity'] += [
            'shop_id' => $this->_shop['id']
        ];
        $this->redpackService->update($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->redpackService->getError())) {
            return $this->setError($this->redpackService->getError());
        }
        $this->setResult($this->redpackService->_data);
    }

    /**
     * 开启活动
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
        $this->redpackService->open($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->redpackService->getError())) {
            return $this->setError($this->redpackService->getError());
        }
        $this->setResult($this->redpackService->_data);
    }

    /**
     * 关闭活动
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
        $this->redpackService->close($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->redpackService->getError())) {
            return $this->setError($this->redpackService->getError());
        }
        $this->setResult($this->redpackService->_data);
    }

    /**
     * 删除活动
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
        $this->redpackService->delete($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->redpackService->getError())) {
            return $this->setError($this->redpackService->getError());
        }
        $this->setResult($this->redpackService->_data);
    }

    /**
     * 参与人员
     */
    public function actionJoin()
    {
        // form处理
        $form = new GeneralForm();
        $get = Yii::$app->request->get();
        $this->checkForm(["GeneralForm" => $get], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->redpackService->get($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->redpackService->getError())) {
            return $this->setError($this->redpackService->getError());
        }
        $model = $this->redpackService->_data;
        if ($model) {
            //群红包活动类型 进入群红包领取页面
            if (isset($model['redPacketEvent']['type']) && $model['redPacketEvent']['type'] == Redpack::TYPE_GROUP) {
                return $this->render('group-join', ['id' => $model['redPacketEvent']['id']]);
            }
            //接龙红包活动类型 进入接龙红包领取页面
            if (isset($model['redPacketEvent']['type']) && $model['redPacketEvent']['type'] == Redpack::TYPE_TRANSMIT) {
                return $this->render('transmit-join', ['id' => $model['redPacketEvent']['id']]);
            }
        }
        return $this->setError('参数有误');
    }


    /**
     * 获取群红包活动领取红包列表【不显示为被领取的红包】
     * 部分查询条件
     * [
     *  'red_packet_event_id', //活动id
     *  'status' //状态，领取中和领取完成的状态
     * ]
     */
    public function actionFindGroupItemListAjax()
    {
        //数据验证和数据请求
        $this->_findItemList();
        // 接收逻辑层处理结果
        if (!is_null($this->redpackService->getError())) {
            return $this->setError($this->redpackService->getError());
        }

        $data = $this->redpackService->_data;
        $this->setResult($data);
    }

    /**
     * 获取接龙红包活动领取红包列表
     */
    public function actionFindTransmitItemListAjax()
    {
        //数据验证和数据请求
        $this->_findItemList();
        // 接收逻辑层处理结果
        if (!is_null($this->redpackService->getError())) {
            return $this->setError($this->redpackService->getError());
        }
        $data = $this->redpackService->_data;
        $this->setResult($data);
    }

    /**
     * 获取红包活动领取红包列表
     * 接龙|群红包公用方法
     */
    private function _findItemList()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $post = Yii::$app->request->post();
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'red_packet_event_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'status' => [Redpack::STATUS_UNDERWAY, Redpack::STATUS_FINISH] //领取中和领取完成状态
        ];
        if(isset($post['nickname']))
        {
            $serviceParams['nickname'] =$post['nickname'];
        }
        $this->getPageInfo($serviceParams);
        $this->redpackService->findItemList($serviceParams);
    }

    /**
     * 单个群红包参与人员记录
     */
    public function actionFindGroupLogAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new FindLogListAjaxForm();
        $this->checkForm(["FindLogListAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);

        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];

        $this->getPageInfo($serviceParams);
        $this->redpackService->findGroupLogList($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->redpackService->getError())) {
            return $this->setError($this->redpackService->getError());
        }
        $this->setResult($this->redpackService->_data);
    }

    /**
     * 获取接龙红包猜中线路记录
     */
    public function actionFindTransmitLogAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new FindLogListAjaxForm();
        $this->checkForm(["FindLogListAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);

        $serviceParams += [
            'is_guess' => Redpack::GUESS_SUCCESS, //猜中的状态
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($serviceParams);
        $this->redpackService->findTransmitLogList($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->redpackService->getError())) {
            return $this->setError($this->redpackService->getError());
        }
        //获取红包瓜分金额
        $model = $this->redpackService->_data;
        $amount = '';
        if (!empty($model)) {
            $amount = $this->redpackService->divide($model['data']); //计算平分金额
        }
        $model['amount'] = $amount;
        $this->setResult($model);
    }
}