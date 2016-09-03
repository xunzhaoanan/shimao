<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */

namespace admin\controllers;

use common\forms\shop\CreateSelfPickupSubForm;
use common\forms\shop\EditManagerPwdAjaxForm;
use common\forms\shop\FindSelfPickupSubForm;
use common\forms\shop\ScanPayAjaxForm;
use common\forms\shop\ShEditAjaxForm;
use common\forms\shop\ManagerAddAjaxForm;
use common\forms\shop\ManagerEditAjaxForm;
use common\forms\shop\PaymentSettingEditAjaxForm;
use common\forms\shop\PaymentSettingListEditAjaxForm;
use common\forms\GeneralForm;
use common\forms\shop\ShippingStatusUpdateForm;
use common\forms\shop\StatementRateUpdateForm;
use common\forms\shop\UploadCertificateAjaxForm;
use common\forms\shop\UploadCertificateForm;
use common\forms\shop\ReservesWarningNumUpdateForm;
use common\forms\shop\ReturnGoodsSettingForm;
use common\forms\shop\AddUsedAddressForm;
use common\forms\shop\UpdateUsedAddressForm;
use common\forms\UploadForm;
use common\helpers\CommonLib;
use common\helpers\TcApi;
use common\models\Shop;
use common\models\Statement;
use common\models\WxQrcode;
use common\services\base\ShopService;
use common\services\weixin\WxQrcodeService;
use Yii;
use common\services\CommonService;
use common\forms\shop\WxAccountAjaxForm;
use yii\web\UploadedFile;
use common\vendor\phpexcel\excel;


class ShopController extends BaseController
{

    protected $terminalModel;
    protected $shopService;
    protected $shopModel;

    function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function init()
    {
        $this->_commonService = new CommonService();
        $this->shopService = new ShopService();
        $this->shopModel = new Shop();
    }

    /**
     * 消息通知设置
     */
    public function actionNoticeSetting()
    {
        return $this->renderPartial('notice-setting');
    }

    /**
     * 扫码支付配置
     */
    public function actionOverdue()
    {
        return $this->renderPartial('overdue');
    }

    /**
     * 扫码支付配置
     */
    public function actionScanPay()
    {
        return $this->render('scan-pay');
    }

    /**
     * 扫码支付配置数据
     */
    public function actionScanPayDataAjax()
    {
        $data = [
            'is_scan_pay' => Shop::STATUS_DISABLE,
            'scan_limit_amount' => ''
        ];
        if (isset($this->_shop['shopSetting']) && is_array($this->_shop['shopSetting']) && count($this->_shop['shopSetting'])) {
            $data = $this->_shop['shopSetting'];
        }
        $this->setResult($data);
    }

    /**
     * 修改扫码支付配置
     */
    public function actionScanPayAjax()
    {
        $form = new ScanPayAjaxForm();
        $this->checkForm(["ScanPayAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->shopModel->updateShopSetting($serviceParams);
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * 开启扫码支付配置
     */
    public function actionScanPayOpenAjax()
    {
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'is_scan_pay' => Shop::STATUS_ENABLE,
        ];
        $this->shopModel->updateShopSetting($serviceParams);
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * 关闭扫码支付配置
     */
    public function actionScanPayCloseAjax()
    {
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'is_scan_pay' => Shop::STATUS_DISABLE,
        ];
        $this->shopModel->updateShopSetting($serviceParams);
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * 商家设置数据补齐
     */
    public function actionConstData()
    {
        $this->shopModel->constData();
        exit;
    }

    /**
     * 库存预警值配置
     */
    public function actionReservesWarningNumUpdate()
    {
        $form = new ReservesWarningNumUpdateForm();
        $this->checkForm(["ReservesWarningNumUpdateForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->shopModel->updateShopSetting($serviceParams);
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * 查看商家信息页面
     */
    public function actionIndex()
    {
        //获取商家二维码
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'operator' => $this->_shopManager['qq'],
            'model' => WxQrcode::MODEL_WSH,
            'model_id' => 1,
            'auto_build' => true
        ];
        $qrcodeService = new WxQrcodeService($this->_wxInfo);
        $qrcodeService->getQrcode($serviceParams);
        $qrcode = $qrcodeService->_data;
        if (!is_null($qrcodeService->getError())) {
            //return $this->setError($qrcodeService->getError());
            $qrcode = '';
        }

        $data = [
            'shop' => $this->_shop,
            'wxInfo' => $this->_wxInfo,
            'qrcode' => $qrcode,
        ];

        return $this->render('index', [
            'data' => $data
        ]);
    }

    /**
     * @api {post} /shop/get-ajax 获取商家信息
     * @apiName get-ajax
     * @apiGroup shop
     * @apiDescription 获取商家信息接口，包含商家设置
     *
     *
     * @apiSuccess {Number}  errcode
     * @apiSuccess {Object}  errmsg 商家信息
     * @apiSuccess {Object}  errmsg.shopSetting
     * @apiSuccess {Number}  errmsg.shopSetting.id 商家设置列表ID
     * @apiSuccess {Number}  errmsg.shopSetting.shop_id 商家ID
     * @apiSuccess {Number}  errmsg.shopSetting.statement_rate 向门店打款费率，百分数
     * @apiSuccess {Number}  errmsg.shopSetting.is_scan_pay 是否开启扫码支付
     * @apiSuccess {Number}  errmsg.shopSetting.scan_limit_amount 单笔扫码支付最大金额
     * @apiSuccess {Number}  errmsg.shopSetting.reserves_warning_num 库存预警值
     * @apiSuccess {Number}  errmsg.shopSetting.boss_auto_refund Boss后台是否自动退款，1是，2否
     * @apiSuccess {Number}  errmsg.shopSetting.return_goods 是否开启退货功能，1是，2否
     * @apiSuccess {String}  errmsg.shopSetting.return_goods_order_type 可退货的订单类型（以,号分割后即为可退货的订单类型集合）
     * @apiSuccess {Number}  errmsg.shopSetting.shipping_status 是否开启快递配送 1是，2否
     * @apiSuccess {Number}  errmsg.shopSetting.self_pickup_status 是否开启自提 1是，2否
     *
     *
     * @apiSuccessExample Success-Response:
     *  {
     *      "errcode": 0,
     *      "errmsg": {
     *          "boss_auto_refund": 1,
     *          "return_goods": 1,
     *          "return_goods_order_type": "1,3,5",
     *          "id": 293,
     *          "is_scan_pay": 1,
     *          "reserves_warning_num": 2,
     *          "scan_limit_amount": 100000,
     *          "shop_id": 30,
     *          "statement_rate": "0.6"
     *          "shipping_status": 1
     *          "self_pickup_status": 1
     *      }
     *  }
     *
     */
    public function actionGetAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $serviceParams = [
            'shop_id' => $this->_shop['id']
        ];
        $this->shopModel->get($serviceParams);
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * 修改商家信息页
     */
    public function actionEdit()
    {
        $data = [
            'shop' => $this->_shop,
            'wxInfo' => $this->_wxInfo
        ];
        return $this->render('edit', [
            'model' => $data
        ]);
    }

    /**
     * 修改管理员密码
     */
    public function actionEditManagerPwd()
    {
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->get()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->shopModel->getManager($serviceParams);
        // 接收model层处理结果
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        return $this->render('edit-manager-pwd', ['model' => $this->shopModel->_data]);
    }

    /**
     * 修改管理员密码
     */
    public function actionEditManagerPwdAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new EditManagerPwdAjaxForm();
        $this->checkForm(["EditManagerPwdAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->shopModel->updateManagerPassword($serviceParams);
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult();
    }

    /**
     * 修改商家信息接口
     */
    public function actionEditAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new ShEditAjaxForm();
        $this->checkForm(["ShEditAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->shopModel->update($serviceParams);
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult();
    }

    /**
     * 删除店铺接口
     */
    public function actionDelAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }

        $post = Yii::$app->request->post();
        // $post = [
        //     'id' => 128,
        // ];

        // form处理
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => $post], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];

        $this->shopService->del($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->shopService->getError())) {
            return $this->setError($this->shopService->getError());
        }
        $this->setResult($this->shopService->_data);
    }

    /**
     * 查看/修改 微信账号信息
     */
    public function actionWxAccount()
    {
        $model = $this->_wxInfo;
        return $this->render('wx-account', ['model' => $model]);
    }

    /**
     * 查看/修改 微信账号信息
     */
    public function actionWxAccountAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new WxAccountAjaxForm();
        $this->checkForm(["WxAccountAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

            'third_party_id' => $this->_wxInfo['id']
        ];
        // 调用逻辑层
        $this->shopService->updateWxAccount($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->shopService->getError())) {
            return $this->setError($this->shopService->getError());
        }
        $this->setResult();
    }

    /**
     * 支付设置列表
     */
    public function actionPaymentSettingList()
    {
        $params = [
            'shop_id' => $this->_shop['id']
        ];
        $this->shopService->paymentSettingList($params);
        // 接收逻辑层处理结果
        if (!is_null($this->shopService->getError())) {
            return $this->setError();
        }
        $model = $this->shopService->_data;
        $auto_refund = $this->_shop['auto_refund'] == 1 ? 1 : 0;
        return $this->render('payment-setting-list', ['model' => $model, 'refundauto' => $auto_refund]);
    }

    /**
     * 修改支付设置列表
     */
    public function actionPaymentSettingListEditAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new PaymentSettingListEditAjaxForm();
        $this->checkForm(["PaymentSettingListEditAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        // 參數合併
        $this->mergeParams($serviceParams, 'pay_settings');
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->shopService->updatePaymentSettingList($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->shopService->getError())) {
            return $this->setError($this->shopService->getError());
        }
        $this->setResult();
    }

    /**
     * 财付通支付设置详情
     */
    public function actionPaymentSettingTenpay()
    {
        $shopModel = new Shop();
        $params = [
            'shop_id' => $this->_shop['id'],
            'type' => $shopModel->payTypeList['tenpay']['val']
        ];
        $this->shopService->getPaymentSetting($params);
        // 接收逻辑层处理结果
        if (!is_null($this->shopService->getError())) {
            return $this->setError();
        }
        $model = $this->shopService->_data;
        //至少把 type (支付类型) 赋值给页面
        $model['type'] = $shopModel->payTypeList['tenpay']['val'];
        return $this->render('payment-setting-tenpay', ['model' => $model]);
    }

    /**
     * 微信支付设置详情
     */
    public function actionPaymentSettingWxpay()
    {
        $shopModel = new Shop();
        $params = [
            'shop_id' => $this->_shop['id'],
            'type' => $shopModel->payTypeList['wxpay']['val']
        ];
        $this->shopService->getPaymentSetting($params);
        // 接收逻辑层处理结果
        if (!is_null($this->shopService->getError())) {
            return $this->setError();
        }
        $model = $this->shopService->_data;
        //至少把 type (支付类型) 赋值给页面
        $model['type'] = $shopModel->payTypeList['wxpay']['val'];
        return $this->render('payment-setting-wxpay', ['model' => $model]);
    }

    /**
     * 新微信支付设置详情
     */
    public function actionPaymentSettingNewWxpay()
    {
        $shopModel = new Shop();
        $params = [
            'shop_id' => $this->_shop['id'],
            'type' => $shopModel->payTypeList['newwxpay']['val']
        ];
        $this->shopService->getPaymentSetting($params);
        // 接收逻辑层处理结果
        if (!is_null($this->shopService->getError())) {
            return $this->setError();
        }
        $model = $this->shopService->_data;
        //至少把 type (支付类型) 赋值给页面
        $model['type'] = $shopModel->payTypeList['newwxpay']['val'];
        return $this->render('payment-setting-new-wxpay', ['model' => $model]);
    }

    /**
     * 代收款设置详情
     */
    public function actionPaymentSettingAgentpay()
    {
        $shopModel = new Shop();
        $params = [
            'shop_id' => $this->_shop['id'],
            'type' => $shopModel->payTypeList['agentpay']['val']
        ];
        $this->shopService->getPaymentSetting($params);
        // 接收逻辑层处理结果
        if (!is_null($this->shopService->getError())) {
            return $this->setError();
        }
        $model = $this->shopService->_data;
        return $this->render('payment-setting-agentpay', ['model' => $model]);
    }

    /**
     * 手Q支付设置详情
     */
    public function actionPaymentSettingQqpay()
    {
        $shopModel = new Shop();
        $params = [
            'shop_id' => $this->_shop['id'],
            'type' => $shopModel->payTypeList['qqpay']['val']
        ];
        $this->shopService->getPaymentSetting($params);
        // 接收逻辑层处理结果
        if (!is_null($this->shopService->getError())) {
            return $this->setError();
        }
        $model = $this->shopService->_data;
        //至少把 type (支付类型) 赋值给页面
        $model['type'] = $shopModel->payTypeList['qqpay']['val'];
        return $this->render('payment-setting-qqpay', ['model' => $model]);
    }

    /**
     * 修改支付配置
     */
    public function actionPaymentSettingEditAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new PaymentSettingEditAjaxForm();
        $this->checkForm(["PaymentSettingEditAjaxForm" => Yii::$app->request->post()], $form);
        $replaceParams = ['id' => 'config_id'];
        $serviceParams = $this->handleForm($form, $replaceParams);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        $this->shopService->updatePaymentSetting($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->shopService->getError())) {
            return $this->setError($this->shopService->getError());
        }
        $this->setResult();
    }

    /**
     * 操作员管理
     * @return string
     */
    public function actionManagerList()
    {
        return $this->render('manager-list');
    }

    /**
     * 操作员管理
     */
    public function actionManagerListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $serviceParams = [
            'shop_id' => $this->_shop['id'],

        ];
        $this->getPageInfo($serviceParams);
        $this->shopModel->findManager($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * 添加操作员
     */
    public function actionManagerAdd()
    {
        return $this->render('manager-add');
    }

    /**
     * ajax 添加操作员
     */
    public function actionManagerAddAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new ManagerAddAjaxForm();
        $this->checkForm(["ManagerAddAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

        ];
        $this->shopModel->createManager($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }


    /**
     * 编辑操作员
     */
    public function actionManagerEdit()
    {
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->get()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

        ];
        $this->shopModel->getManager($serviceParams);
        // 接收model层处理结果
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        return $this->render('manager-edit', ['model' => $this->shopModel->_data]);
    }

    /**
     * ajax 修改操作员
     */
    public function actionManagerEditAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new ManagerEditAjaxForm();
        $this->checkForm(["ManagerEditAjaxForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],

        ];
        if ($serviceParams['role_id'] == -1) {
            $serviceParams['role_id'] = 0;
        }
        $this->shopModel->updateManager($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * 删除管理员
     */
    public function actionManageDelAjax()
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
        $this->shopModel->delManager($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * 上传证书
     * @return string
     */
    public function actionUploadCertificate()
    {
        return $this->render('upload-certificate');
    }

    /**
     * 上传证书
     */
    public function actionUploadCertificateAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $model = new UploadCertificateForm();

        $model->secret_file = UploadedFile::getInstance($model, 'secret_file');
        $model->key_file = UploadedFile::getInstance($model, 'key_file');
        if (empty($model->secret_file) || empty($model->key_file)) {
            $this->redirect(array('/shop/upload-certificate?code=1005'));
        }
        if (file_exists($model->secret_file->tempName)) {
            if (strpos($model->secret_file->name, 'pem') === false) {
                //$this->sentMsg('导入文件格式非法!', 'import');
                $this->redirect(array('/shop/upload-certificate?code=1001'));
            }

            $postArr['plat_id '] = 2;
            $postArr['user_id'] = 1;
            $postArr['shop_id'] = $this->_shop['id'];

            $file1 = "";
            $file2 = "";
            if (isset($model->secret_file->tempName) && !empty($model->secret_file->tempName)) {
                $fp = fopen($model->secret_file->tempName, 'rb');  // 以二进制形式打开文件
                $file1 = fread($fp, $model->secret_file->size); // 读取文件内容
                fclose($fp);
                $file1 = base64_encode($file1);
            }
            if (isset($model->key_file->tempName) && !empty($model->key_file->tempName)) {
                $fp = fopen($model->key_file->tempName, 'rb');  // 以二进制形式打开文件
                $file2 = fread($fp, $model->key_file->size); // 读取文件内容
                fclose($fp);
                $file2 = base64_encode($file2);
            }

            $postArr['tmp_pem_file'] = $file1;
            $postArr['tmp_key_file'] = $file2;

            $tcApi = new TcApi();
            $back = $tcApi->uploadCertificate(2, $postArr);//echo $back;exit;

            if ($back === false) {
                Yii::info($this->_shop['id'] . '上传证书接口调用失败');
                $this->redirect(array('/shop/upload-certificate?code=1006'));
            }
            $back = json_decode($back, true);
            if (!$back) {
                Yii::info($this->_shop['id'] . '上传证书回调JSON格式错误');
                $this->redirect(array('/shop/upload-certificate?code=1006'));
            }


            $code = $back['code'];
            if ($code == 100) {
                $serviceParams = array();
                $serviceParams['shop_id'] = $this->_shop['id'];
                $serviceParams['auto_refund'] = Shop::STATUS_ENABLE;
                $this->shopModel->update($serviceParams);

                if (!is_null($this->shopModel->getError())) {
                    return $this->setError($this->shopModel->getError());
                }
                $this->redirect(array('/shop/upload-certificate?code=1000'));
            } else {
                Yii::info($this->_shop['id'] . '上传证书失败：' . $back['codemsg']);
                $this->redirect(array('/shop/upload-certificate?code=1006'));
            }

        } else {
            $this->redirect(array('/shop/upload-certificate?code=1003'));
        }
    }

    /**
     * 开发者
     * @return string
     */
    public function actionDeveloper()
    {
        $serviceParams = [
            'shop_id' => $this->_shop['id']
        ];
        $result = $this->shopModel->getDeveloper($serviceParams);
        $result = json_decode($result, true);
        if ($result['errcode'] != 0) {
            return $this->setError($result);
        }
        return $this->render('developer', ['model' => ['data' => $result['data'], 'doc_url' => Shop::DEVELOPER_WIKI]]);
    }

    /**
     * 开启开发者
     */
    public function actionOpenDeveloperToolAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'shop_name' => $this->_shop['name']
        ];
        $result = $this->shopModel->createDeveloper($serviceParams);
        $result = json_decode($result, true);
        if ($result['errcode'] != 0) {
            return $this->setError($result);
        }
        $this->setResult($result);
    }

    /**
     * 没有访问权限
     */
    public function actionError()
    {
        return $this->renderPartial('error');
    }

    /**
     * 对账单设置
     */
    public function actionBillSetting()
    {
        return $this->render('bill-setting', ['model' => (isset($this->_shop['shopSetting']) ? $this->_shop['shopSetting'] : '')]);
    }

    /**
     * 对账单设置跳转
     */
    public function actionStatementRecordInfo()
    {
        return $this->render('statement-record-info');
    }

    /**
     * @api {post} /shop/statement-rate-update 01.对账单转账费率配置
     * @apiName statement-rate-update
     * @apiGroup shop
     *
     * @apiParam {Number} statement_rate  必填，向门店打款费率，百分数
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Number}  id 商家设置列表ID
     * @apiSuccess {Number}  shop_id 商家ID
     * @apiSuccess {Number}  statement_rate 向门店打款费率，百分数
     * @apiSuccess {Number}  is_scan_pay 是否开启扫码支付
     * @apiSuccess {Number}  scan_limit_amount 单笔扫码支付最大金额
     * @apiSuccess {Number}  reserves_warning_num 库存预警值
     * @apiSuccess {Number}  boss_auto_refund Boss后台是否自动退款，1是，2否
     *
     *
     * @apiSuccessExample Success-Response:
     *  {
     *      "errcode": 0,
     *      "errmsg": {
     *          "boss_auto_refund": 1,
     *          "id": 293,
     *          "is_scan_pay": 1,
     *          "reserves_warning_num": 2,
     *          "scan_limit_amount": 100000,
     *          "shop_id": 30,
     *          "statement_rate": "0.6"
     *      }
     *  }
     *
     */
    public function actionStatementRateUpdate()
    {
        $form = new StatementRateUpdateForm();
        $this->checkForm(["StatementRateUpdateForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->shopModel->updateShopSetting($serviceParams);
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * @api {post} /shop/import-excel 02.导入终端店收款账户
     * @apiName import-excel
     * @apiGroup shop
     *
     * @apiParam {File} file 必选,导入的文件
     *
     *
     * @apiErrorExample Error-Response:
     *    {
     *    "errcode": -3,
     *    "errmsg": "服务器忙，请稍后再尝试"
     *    }
     *
     */
    public function actionImportExcel()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $model = new UploadForm();
        $model->file = UploadedFile::getInstance($model, 'file');
        //pr($model->file);
        if (strpos($model->file->name, 'xls') === false) {
            //$this->sentMsg('导入文件格式非法!', 'import');
            $this->redirect(array('/shop/bill-setting?code=1001'));
        }
        try {
            if (file_exists($model->file->tempName)) {
                $fileName = rand(1, 1000) . time();
                if (!file_exists(Yii::$app->getRuntimePath() . '/excel/')) {
                    mkdir(Yii::$app->getRuntimePath() . '/excel/');
                }
                $uploadExcel = Yii::$app->getRuntimePath() . '/excel/' . $fileName . '.xls';
                if (move_uploaded_file($model->file->tempName, $uploadExcel)) {
                    $data = excel::getExcelData($uploadExcel);
                }
                if (count($data) <= 1 || !is_array($data)) {
                    $this->redirect(array('/shop/bill-setting?code=1002'));
                }
                if (!$data[count($data) - 1][0]) {
                    unset($data[count($data) - 1]);
                }
                unset($data[0]);

                //pr($data);

                //处理数据
                $statementModel = new Statement();
                $statementParams = array();
                foreach ($data as $statementItem) {

                    $statementParams['shop_id'] = $this->_shop['id'];
                    $statementParams['shop_sub_id'] = isset($statementItem[0]) ? trim($statementItem[0]) : '';
                    $statementParams['payee'] = isset($statementItem[2]) ? trim(CommonLib::utf8Substr($statementItem[2], 0, 10)) : '';//只保留10个字
                    $statementParams['due_bank'] = isset($statementItem[3]) ? trim(CommonLib::utf8Substr($statementItem[3], 0, 20)) : '';//只保留20个字
                    $statementParams['opening_bank'] = isset($statementItem[4]) ? trim(CommonLib::utf8Substr($statementItem[4], 0, 20)) : '';//只保留20个字
                    $statementParams['account_no'] = isset($statementItem[5]) ? trim(preg_replace('/\D/', '', $statementItem[5])) : '';//去除非数字
                    $statementParams['tel'] = isset($statementItem[6]) ? trim(preg_replace('/\D/', '', $statementItem[6])) : '';//去除非数字

                    //就算所有数据为空，也要执行更新，以导入的表格数据为准
                    $statementModel->statementReceiveSetting($statementParams);
                }

                // 接收逻辑层处理结果
                if (!is_null($statementModel->getError())) {
                    //return $this->setError($this->memberService->getError());
                    $msg = $statementModel->getError()['errmsg'];
                    if ($statementModel->getError()['errcode'] == 10003) {
                        $msg = '文件填写错误或格式不符，请重新导入';
                    }
                    $this->redirect(array('/shop/bill-setting?code=1005&msg=' . $msg));
                }
                $this->redirect(array('/shop/bill-setting?code=1000'));
            } else {
                $this->redirect(array('/shop/bill-setting?code=1003'));
            }
        } catch (\Exception $e) {
            $this->redirect(array('/shop/bill-setting?code=1006'));
        }

    }

    /**
     * @api {post} /shop/return-goods-setting-update 03.退货设置(开关以及订单设置)
     * @apiName return-goods-setting-update
     * @apiGroup shop
     * @apiVersion 0.4.5
     * @apiDescription 选填参数必须两者填写任意一个
     *
     * @apiParam {Number} return_goods  可选，是否开启退货功能，1是，2否
     * @apiParam {String} return_goods_order_type  可选(maxLength 50)，可退货的订单类型（参照订单详情获取接口 将订单类型以','隔开 例如1,3,5 每一个类型必须为订单详情order_type中的一种）
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Number}  id 商家设置列表ID
     * @apiSuccess {Number}  shop_id 商家ID
     * @apiSuccess {Number}  statement_rate 向门店打款费率，百分数
     * @apiSuccess {Number}  is_scan_pay 是否开启扫码支付
     * @apiSuccess {Number}  scan_limit_amount 单笔扫码支付最大金额
     * @apiSuccess {Number}  reserves_warning_num 库存预警值
     * @apiSuccess {Number}  boss_auto_refund Boss后台是否自动退款，1是，2否
     * @apiSuccess {Number}  return_goods 是否开启退货功能，1是，2否
     * @apiSuccess {String}  return_goods_order_type 可退货的订单类型（以,号分割后即为可退货的订单类型集合）
     *
     *
     * @apiSuccessExample Success-Response:
     *  {
     *      "errcode": 0,
     *      "errmsg": {
     *          "boss_auto_refund": 1,
     *          "return_goods": 1,
     *          "return_goods_order_type": "1,3,5",
     *          "id": 293,
     *          "is_scan_pay": 1,
     *          "reserves_warning_num": 2,
     *          "scan_limit_amount": 100000,
     *          "shop_id": 30,
     *          "statement_rate": "0.6"
     *      }
     *  }
     *
     */
    public function actionReturnGoodsSettingUpdate()
    {
        $form = new ReturnGoodsSettingForm();
        $this->checkForm(["ReturnGoodsSettingForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams['shop_id'] = $this->_shop['id'];

        $this->shopModel->updateShopSetting($serviceParams);
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * @api {post} /shop/add-used-address-ajax 04.添加常用地址
     * @apiName add-used-address-ajax
     * @apiGroup shop
     * @apiVersion 0.4.5
     * @apiDescription 添加常用地址(目前退货用)
     *
     * @apiParam {String} return_address  必填(maxLength 300)，退货地址
     * @apiParam {String} return_consignee  必填(maxLength 50)，退货联系人
     * @apiParam {String} return_phone  必填(maxLength 16)，退货联系人电话
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Number} errmsg.id 此条记录id
     * @apiSuccess {String} errmsg.return_address 退货地址
     * @apiSuccess {String} errmsg.return_consignee 退货联系人
     * @apiSuccess {String} errmsg.return_phone 退货联系人电话
     * @apiSuccess {Number} errmsg.deleted 是否删除（1.开启 2.禁用 3.删除）
     * @apiSuccess {Number} errmsg.shop_id 总店id
     * @apiSuccess {Number} errmsg.shop_sub_id 分店ID
     * @apiSuccess {timestamp} errmsg.created 创建时间
     * @apiSuccess {timestamp} errmsg.modified 最后更改时间
     *
     *
     * @apiSuccessExample Success-Response:
     *  {
     *      "errcode": 0,
     *      "errmsg": {
     *          "id": 293,
     *          "return_address": "asdasdsa",
     *          "return_consignee": "asdasdsa",
     *          "return_phone": "asdasdsa",
     *          "shop_id": 30,
     *          "shop_sub_id": 0,
     *          "created": 0,
     *          "modified": 0,
     *          "deleted": 1,
     *      }
     *  }
     *
     */
    public function actionAddUsedAddressAjax()
    {
        $form = new AddUsedAddressForm();
        $this->checkForm(["AddUsedAddressForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams['shop_id'] = $this->_shop['id'];

        $this->shopModel->addUsedAddress($serviceParams);
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * @api {post} /shop/get-used-address-list-ajax 05.获取常用地址列表
     * @apiName get-used-address-list-ajax
     * @apiGroup shop
     * @apiVersion 0.4.5
     * @apiDescription 获取常用地址列表(目前退货用)
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Number} errmsg.id 此条记录id
     * @apiSuccess {String} errmsg.return_address 退货地址
     * @apiSuccess {String} errmsg.return_consignee 退货联系人
     * @apiSuccess {String} errmsg.return_phone 退货联系人电话
     * @apiSuccess {Number} errmsg.deleted 是否删除（1.开启 2.禁用 3.删除）
     * @apiSuccess {Number} errmsg.shop_id 总店id
     * @apiSuccess {Number} errmsg.shop_sub_id 分店ID
     * @apiSuccess {timestamp} errmsg.created 创建时间
     * @apiSuccess {timestamp} errmsg.modified 最后更改时间
     *
     *
     * @apiSuccessExample Success-Response:
     *  {
     *      "errcode": 0,
     *      "errmsg": {
     *          "id": 293,
     *          "return_address": "asdasdsa",
     *          "return_consignee": "asdasdsa",
     *          "return_phone": "asdasdsa",
     *          "shop_id": 30,
     *          "shop_sub_id": 0,
     *          "created": 0,
     *          "modified": 0,
     *          "deleted": 1,
     *      }
     *  }
     *
     */
    public function actionGetUsedAddressListAjax()
    {
        $serviceParams['shop_id'] = $this->_shop['id'];
        $this->getPageInfo($serviceParams);
        $this->shopModel->getUsedAddressList($serviceParams);

        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * @api {post} /shop/update-used-address-ajax 06.更新某条常用地址
     * @apiName update-used-address-ajax
     * @apiGroup shop
     * @apiVersion 0.4.5
     * @apiDescription 更新某条常用地址，如果只传id，会将此条地址设为默认地址（列表中第一个）
     *
     * @apiParam {Number} id  必填，该条常用地址对应的id
     * @apiParam {String} return_address  选填(maxLength 300)，退货地址
     * @apiParam {String} return_consignee  选填(maxLength 50)，退货联系人
     * @apiParam {String} return_phone  选填(maxLength 16)，退货联系人电话
     * @apiParam {Number} deleted  选填，只能等于3 (3表示删除)
     *
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg (返回字段说明参照/shop/add-used-address-ajax)
     *
     *
     * @apiSuccessExample Success-Response:
     *  {
     *      "errcode": 0,
     *      "errmsg": {
     *          "id": 293,
     *      }
     *  }
     *
     */
    public function actionUpdateUsedAddressAjax()
    {
        $form = new UpdateUsedAddressForm();
        $this->checkForm(["UpdateUsedAddressForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams['shop_id'] = $this->_shop['id'];

        $this->shopModel->updateUsedAddress($serviceParams);

        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * @api {post} /shop/shipping-status-update 07.更新商品配送设置（自提&快递）
     * @apiName shipping-status-update
     * @apiGroup shop
     * @apiDescription 选填参数必须两者任意一个为开（不可全部关闭）
     *
     * @apiParam {Number} shipping_status  可选，是否开启快递配送，1是，2否
     * @apiParam {Number} self_pickup_status  可选，是否开启自提，1是，2否
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Number}  id 商家设置列表ID
     * @apiSuccess {Number}  shop_id 商家ID
     * @apiSuccess {Number}  statement_rate 向门店打款费率，百分数
     * @apiSuccess {Number}  is_scan_pay 是否开启扫码支付
     * @apiSuccess {Number}  scan_limit_amount 单笔扫码支付最大金额
     * @apiSuccess {Number}  reserves_warning_num 库存预警值
     * @apiSuccess {Number}  boss_auto_refund Boss后台是否自动退款，1是，2否
     * @apiSuccess {Number}  return_goods 是否开启退货功能，1是，2否
     * @apiSuccess {String}  return_goods_order_type 可退货的订单类型（以,号分割后即为可退货的订单类型集合）
     * @apiSuccess {Number}  shipping_status 是否开启快递配送 1是，2否
     * @apiSuccess {Number}  self_pickup_status 是否开启自提 1是，2否
     *
     *
     * @apiSuccessExample Success-Response:
     *  {
     *      "errcode": 0,
     *      "errmsg": {
     *          "boss_auto_refund": 1,
     *          "return_goods": 1,
     *          "return_goods_order_type": "1,3,5",
     *          "id": 293,
     *          "is_scan_pay": 1,
     *          "reserves_warning_num": 2,
     *          "scan_limit_amount": 100000,
     *          "shop_id": 30,
     *          "statement_rate": "0.6"
     *          "shipping_status": 1
     *          "self_pickup_status": 1
     *      }
     *  }
     *
     */
    public function actionShippingStatusUpdate()
    {
        $form = new ShippingStatusUpdateForm();
        $this->checkForm(["ShippingStatusUpdateForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams['shop_id'] = $this->_shop['id'];

        $this->shopModel->updateShopSetting($serviceParams);
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * @api {post} /shop/create-self-pickup-sub-ajax 08.添加自提点
     * @apiName create-self-pickup-sub-ajax
     * @apiGroup shop
     * @apiDescription 自提点店铺只能是直营店
     *
     * @apiParam {Array} shop_sub_id  必填，直营店的id(店铺列表接口中的id)
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Number} errmsg 成功数量（不会超过shop_sub_id的length）
     *
     *
     * @apiSuccessExample Success-Response:
     *  {
     *      "errcode": 0,
     *      "errmsg": 2
     *  }
     *
     */
    public function actionCreateSelfPickupSubAjax()
    {
        $form = new CreateSelfPickupSubForm();
        $this->checkForm(["CreateSelfPickupSubForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams['shop_id'] = $this->_shop['id'];

        $this->shopModel->createSelfPickupSub($serviceParams);
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * @api {post} /shop/del-self-pickup-sub-ajax 09.删除自提点
     * @apiName del-self-pickup-sub-ajax
     * @apiGroup shop
     * @apiDescription 删除自提点
     *
     * @apiParam {Array} shop_sub_id  必填，已选自提店铺id(自提点获取接口中的shop_sub_id)
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Number} errmsg 成功数量（不会超过shop_sub_id的length）
     *
     *
     * @apiSuccessExample Success-Response:
     *  {
     *      "errcode": 0,
     *      "errmsg": 2
     *  }
     *
     */
    public function actionDelSelfPickupSubAjax()
    {
        $form = new CreateSelfPickupSubForm();
        $this->checkForm(["CreateSelfPickupSubForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams['shop_id'] = $this->_shop['id'];

        $this->shopModel->delSelfPickupSub($serviceParams);
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * @api {post} /shop/find-self-pickup-sub-ajax 10.获取自提点店铺信息
     * @apiName find-self-pickup-sub-ajax
     * @apiGroup shop
     * @apiDescription 获取自提点店铺信息
     *
     * @apiParam {Number} province_id  选填，省份id
     * @apiParam {Number} city_id  选填，城市id
     * @apiParam {Number} district_id  选填，区id
     * @apiParam {String} name  选填（Max50），商户名称
     * @apiParam {Number} page  选填，页码
     * @apiParam {Number} count  选填，每页数据量（默认20）
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg 自提点店铺列表信息，可能为空
     *
     *
     * @apiSuccessExample Success-Response:
     *  {
     *      "errcode": 0,
     *      "errmsg": {
     *         "data":[
     *              {
     *              "id": 308,
     *              "pid": 0,
     *              "shop_id": 30,
     *              "lng": 116.4574346059,
     *              "lat": 39.901252709632,
     *              "sync_setting": 1,
     *              "shop_type": 1,
     *              "agent_path": null,
     *              "agent_id": 0,
     *              "is_pickup_shop": 2,
     *              "is_fx": 1,
     *              "qrcode_policy_id": 0,
     *              "qrcode_scan_count": null,
     *              "created": 1451973968,
     *              "modified": 1463465112,
     *              "deleted": 1,
     *              "shopInfo": {
     *                  "id": 288,
     *                  "shop_id": 30,
     *                  "shop_sub_id": 308,
     *                  "name": "地方好地方3ff",
     *                  "bg_img": "http://imgcache.vikduo.com/static/ac2d26a851781515c2974758e9f70f83.png",
     *                  "description": "45",
     *                  "theme": null,
     *                  "category_del_id": null,
     *                  "ewm_img": "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQG58DoAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xL1pVTnpaX3ptYTVFU3pDbkVHMl9wAAIE69LFVQMEAAAAAA%3D%3D",
     *                  "scene_id": 81,
     *                  "site_img": null,
     *                  "lbs": 1,
     *                  "phone": "13636523563",
     *                  "province_id": 1,
     *                  "city_id": 2,
     *                  "district_id": 3,
     *                  "circle_id": 4,
     *                  "address": "56",
     *                  "businesshour": "02:26-23:36",
     *                  "url": "http://www.baidu.com",
     *                  "wx_categories": "[{\"id\":\"1\",\"name\":\"\\u7f8e\\u98df\"},{\"id\":\"2\",\"name\":\"\\u6c5f\\u6d59\\u83dc\"},{\"id\":\"3\",\"name\":\"\\u4e0a\\u6d77\\u83dc\"}]",
     *                  "available_status": 1,
     *                  "recommend": "56",
     *                  "special": "321",
     *                  "avg_price": 45,
     *                  "poi_id": null,
     *                  "wifi_shop_id": null,
     *                  "check_time": null,
     *                  "fail_msg": null,
     *                  "update_status": 0,
     *                  "created": 1451973968,
     *                  "modified": 1463465112,
     *                  "deleted": 1
     *                  }
     *              }
     *          ],
     *          "page": {
     *              "per_page": 20,
     *              "total_count": 2,
     *              "current_page": 0,
     *              "total_page": 1
     *          }
     *      }
     *  }
     *
     */
    public function actionFindSelfPickupSubAjax()
    {
        $form = new FindSelfPickupSubForm();
        $this->checkForm(["FindSelfPickupSubForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams['shop_id'] = $this->_shop['id'];
        $this->getPageInfo($serviceParams);
        $this->shopModel->findSelfPickupSub($serviceParams);
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }
}