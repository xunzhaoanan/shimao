<?php

namespace admin\controllers;

use common\forms\GeneralForm;
use common\forms\sms\SmsFlowListForm;
use common\forms\sms\SmsPackageListForm;
use common\forms\sms\SmsSendListForm;
use common\services\sms\SmsService;
use Yii;
use common\helpers\ParamsFilter;
use common\helpers\CommonLib;


class SmsController extends BaseController
{

    protected $smsService;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->smsService = new SmsService();
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 短信账户
     */
    public function actionSmsAccount()
    {
        return $this-> render('sms-account');
    }

    /**
     * 充值
     */
    public function actionRecharge()
    {
        return  $this-> render('recharge');
    }

    /**
     * 商家信息
     */
    public function actionSellerInfo()
    {
        return $this->render('seller-info');
    }

    /**
     * @api {post} /sms/list-ajax 01.发送统计列表
     * @apiName list-ajax
     * @apiGroup Sms
     *
     * @apiParam {Number} _page 选填,页码
     * @apiParam {Number} _page_size 选填,每页数据量
     * @apiParam {Number} createStart 选填,短信发送时间开始
     * @apiParam {Number} createEnd 选填,短信发送时间结束
     * @apiParam {String} mobile 选填,接收短信手机号码
     * @apiParam {Number} status 选填,1发送成功 2发送失败
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Array}  errmsg.data 列表数据
     * @apiSuccess {Number} errmsg.data.0.id 短信发送记录ID
     * @apiSuccess {Number} errmsg.data.0.boss_message_type_id 关联id 无作用
     * @apiSuccess {Number} errmsg.data.0.created 创建时间
     * @apiSuccess {String} errmsg.data.0.mobile 接收短信手机号码
     * @apiSuccess {Number} errmsg.data.0.modified 最后修改时间
     * @apiSuccess {String} errmsg.data.0.send_content 短信内容
     * @apiSuccess {Number} errmsg.data.0.send_sms_num 计费数量，即实际发送短信条数
     * @apiSuccess {Number} errmsg.data.0.send_time 短信发送时间
     * @apiSuccess {Number} errmsg.data.0.shop_id 总店ID
     * @apiSuccess {Number} errmsg.data.0.status 1发送成功 2发送失败(短信余量不足) 3发送失败(系统发送失败)
     *
     * @apiSuccess {Array} errmsg.page 页码数据
     * @apiSuccess {Number} errmsg.page.per_page 每页数据量
     * @apiSuccess {Number} errmsg.page.total_count 总数据量
     * @apiSuccess {Number} errmsg.page.current_page 当前页码（从0开始，相当于_page=1）
     * @apiSuccess {Number} errmsg.page.total_page 总页数
     *
     * @apiSuccessExample Success-Response:
     * {
     * "errcode": 0,
     * "errmsg": {
     *          "data": [
     *              0:
     *              {
     *                  "boss_message_type_id": 1,
     *                  "created": 1462331688,
     *                  "id": 1,
     *                  "mobile": "15989898998",
     *                  "modified": 1462331688,
     *                  "send_content": "啊啊啊",
     *                  "send_sms_num": 1,
     *                  "send_time": 1462331688,
     *                  "shop_id": 30,
     *                  "status": 1,
     *              }
     *              ......
     *          ],
     *          "page": {
     *              "per_page": 10,
     *              "total_count": 1,
     *              "current_page": 0,
     *              "total_page": 1
     *          }
     *      }
     * }
     *
     *
     * @apiErrorExample Error-Response:
     *    {
     *    "errcode": -3,
     *    "errmsg": "服务器忙，请稍后再尝试"
     *    }
     */
    public function actionListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new SmsSendListForm();
        $this->checkForm(null, $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->getPageInfo($serviceParams);
        $this->smsService->findSmsSendLogList($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->smsService->getError())) {
            return $this->setError($this->smsService->getError());
        }
        $this->setResult($this->smsService->_data);
    }

    /**
     * @api {post} /sms/count-ajax 02.短信数量
     * @apiName count-ajax
     * @apiGroup Sms
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Array}  errmsg.data 列表数据
     * @apiSuccess {Number} errmsg.data.balance_num 短信余量
     * @apiSuccess {Number} errmsg.data.un_receive_gift_sms_num 待领取短信数量
     *
     * @apiSuccessExample Success-Response:
     * {
     * "errcode": 0,
     * "errmsg": {
     *          "data":
     *              {
     *                  "balance_num": 100,
     *                  "un_receive_gift_sms_num": "1",
     *              }
     *      }
     * }
     *
     * @apiErrorExample Error-Response:
     *    {
     *    "errcode": -3,
     *    "errmsg": "服务器忙，请稍后再尝试"
     *    }
     */
    public function actionCountAjax()
    {
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
        ];
        $this->smsService->getSmsShop($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->smsService->getError())) {
            return $this->setError($this->smsService->getError());
        }
        $this->setResult($this->smsService->_data);
    }

    /**
     * @api {post} /sms/package-list-ajax 03.充值套餐列表
     * @apiName package-list-ajax
     * @apiGroup Sms
     *
     * @apiParam {Number} _page 选填,页码
     * @apiParam {Number} _page_size 选填,每页数据量
     * @apiParam {Number} type 选填,1充值套餐 2赠送套餐
     * @apiParam {Number} status 选填,1上架 2下架
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Array}  errmsg.data 列表数据
     * @apiSuccess {Number} errmsg.data.0.boss_version_id 版本表ID
     * @apiSuccess {Number} errmsg.data.0.created 创建时间
     * @apiSuccess {Number} errmsg.data.0.deleted
     * @apiSuccess {Number} errmsg.data.0.gift_sms_num 充值或赠送套餐赠送的短信条数
     * @apiSuccess {Number} errmsg.data.0.id 套餐列表ID
     * @apiSuccess {Number} errmsg.data.0.modified 最后修改时间
     * @apiSuccess {String} errmsg.data.0.name 套餐名称
     * @apiSuccess {Number} errmsg.data.0.recharge_money 充值金额
     * @apiSuccess {Number} errmsg.data.0.recharge_sms_num 充值送短信条数
     * @apiSuccess {Array} errmsg.data.0.smsOrders 赠送套餐领取记录
     * @apiSuccess {Number} errmsg.data.0.sort 排序
     * @apiSuccess {Number} errmsg.data.0.status 1上架 2下架
     * @apiSuccess {Number} errmsg.data.0.total_num 累计充值或赠送次数
     * @apiSuccess {Number} errmsg.data.0.type 1充值套餐 2赠送套餐
     *
     * @apiSuccess {Array} errmsg.page 页码数据
     * @apiSuccess {Number} errmsg.page.per_page 每页数据量
     * @apiSuccess {Number} errmsg.page.total_count 总数据量
     * @apiSuccess {Number} errmsg.page.current_page 当前页码（从0开始，相当于_page=1）
     * @apiSuccess {Number} errmsg.page.total_page 总页数
     *
     * @apiSuccessExample Success-Response:
     * {
     * "errcode": 0,
     * "errmsg": {
     *          "data": [
     *              0:
     *              {
     *                  "boss_version_id": 1,
     *                  "created": 1462325375,
     *                  "deleted": 1,
     *                  "gift_sms_num": 1,
     *                  "id": 1,
     *                  "modified": 1462325375,
     *                  "name": "付费套餐1",
     *                  "recharge_money": 1,
     *                  "recharge_sms_num": 10,
     *                  "smsOrders": [],
     *                  "sort": 0,
     *                  "status": 1,
     *                  "total_num": 0,
     *                  "type": 1
     *              }
     *              ......
     *          ],
     *          "page": {
     *              "per_page": 10,
     *              "total_count": 1,
     *              "current_page": 0,
     *              "total_page": 1
     *          }
     *      }
     * }
     *
     *
     * @apiErrorExample Error-Response:
     *    {
     *    "errcode": -3,
     *    "errmsg": "服务器忙，请稍后再尝试"
     *    }
     */
    public function actionPackageListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new SmsPackageListForm();
        $this->checkForm(null, $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
            'sortStr' => ['sort' => 'desc', 'id' => 'desc'],
        ];
        $this->getPageInfo($serviceParams);
        $this->smsService->findSmsPackageList($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->smsService->getError())) {
            return $this->setError($this->smsService->getError());
        }
        $this->setResult($this->smsService->_data);
    }

    /**
     * @api {post} /sms/flow-list-ajax 04.充值与赠送领取订单列表
     * @apiName flow-list-ajax
     * @apiGroup Sms
     *
     * @apiParam {Number} _page 选填,页码
     * @apiParam {Number} _page_size 选填,每页数据量
     * @apiParam {Number} createStart 选填,短信发送时间开始
     * @apiParam {Number} createEnd 选填,短信发送时间结束
     * @apiParam {String} order_no 选填,订单单号
     * @apiParam {Number} recharge_type 选填,1微信充值 2系统赠送
     * @apiParam {Number} status 选填,订单状态 1未支付 2成功支付或已领取
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Array}  errmsg.data 列表数据
     * @apiSuccess {Number} errmsg.data.0.created 创建时间
     * @apiSuccess {Number} errmsg.data.0.gift_sms_num 充值或赠送套餐赠送的短信条数
     * @apiSuccess {Number} errmsg.data.0.id 表ID
     * @apiSuccess {Number} errmsg.data.0.modified 最后修改时间
     * @apiSuccess {String} errmsg.data.0.order_no 订单单号
     * @apiSuccess {Number} errmsg.data.0.recharge_money 充值金额
     * @apiSuccess {Number} errmsg.data.0.recharge_sms_num 充值送短信条数
     * @apiSuccess {Number} errmsg.data.0.recharge_type 1微信充值 2系统赠送
     * @apiSuccess {Number} errmsg.data.0.shop_id 总店ID
     * @apiSuccess {Number} errmsg.data.0.shop_manager_id 操作员ID
     * @apiSuccess {Array} errmsg.data.0.smsPackage 短信套餐信息
     * @apiSuccess {String} errmsg.data.0.smsPackage.name 短信套餐名称
     * @apiSuccess {Number} errmsg.data.0.sms_package_id 短信套餐表ID
     * @apiSuccess {Number} errmsg.data.0.status 订单状态 1未支付 2成功支付或领取
     *
     * @apiSuccess {Array} errmsg.page 页码数据
     * @apiSuccess {Number} errmsg.page.per_page 每页数据量
     * @apiSuccess {Number} errmsg.page.total_count 总数据量
     * @apiSuccess {Number} errmsg.page.current_page 当前页码（从0开始，相当于_page=1）
     * @apiSuccess {Number} errmsg.page.total_page 总页数
     *
     * @apiSuccessExample Success-Response:
     * {
     * "errcode": 0,
     * "errmsg": {
     *          "data": [
     *              0:
     *              {
     *                  "created": 1462325375,
     *                  "gift_sms_num": 100,
     *                  "id": 2,
     *                  "modified": 1462325375,
     *                  "order_no": "1111",
     *                  "recharge_money": 100,
     *                  "recharge_sms_num": 2,
     *                  "recharge_type": 1,
     *                  "shop_id": 30,
     *                  "shop_manager_id": null,
     *                  "smsPackage": [
     *                      "name":"付费套餐1",
     *                      .....
     *                  ],
     *                  "sms_package_id": 2,
     *                  "status": 1
     *              }
     *              ......
     *          ],
     *          "page": {
     *              "per_page": 10,
     *              "total_count": 1,
     *              "current_page": 0,
     *              "total_page": 1
     *          }
     *      }
     * }
     *
     * @apiErrorExample Error-Response:
     *    {
     *    "errcode": -3,
     *    "errmsg": "服务器忙，请稍后再尝试"
     *    }
     */
    public function actionFlowListAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new SmsFlowListForm();
        $this->checkForm(null, $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->getPageInfo($serviceParams);
        $this->smsService->findSmsRechargeOrderList($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->smsService->getError())) {
            return $this->setError($this->smsService->getError());
        }
        $this->setResult($this->smsService->_data);
    }

    /**
     * @api {post} /sms/rechange-ajax 05.套餐充值
     * @apiName rechange-ajax
     * @apiGroup Sms
     *
     * @apiParam {Number} id 套餐id
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {String} errmsg
     * @apiSuccess {String} errmsg.url 支付的url
     *
     * @apiSuccessExample Success-Response:
     * {
     *     "errcode": 0,
     *     "errmsg": {
     *          "url": "https://gw.tenpay.com/gateway/pay.htm?agent_type=&agentid=&attach=&bank_type=DEFAULT&body=%E4%BB%98%E8%B4%B9%E5%A5%97%E9%A4%902&buyer_id=&fee_type=1&goods_tag=&input_charset=utf-8&notify_url=http%3A%2F%2F46.newwsh.vikduo.com%2Ftenpay-callback%2Fsms-order-notice&out_trade_no=SMS2016050614365206936&partner=1217092301&product_fee=&return_url=http%3A%2F%2F46.newwsh.vikduo.com%2Fsms%2Frecharge&seller_id=&service_version=1.0&sign=8302e299a43000fb3c6b5695c992129f&sign_key_index=1&sign_type=MD5&spbill_create_ip=0.0.0.0&subject=%E4%BB%98%E8%B4%B9%E5%A5%97%E9%A4%902&time_expire=&time_start=20160506143652&total_fee=10&trade_mode=1&trans_type=1&transport_desc=&transport_fee=0"
     *      }
     * }
     *
     *
     * @apiErrorExample Error-Response:
     *    {
     *    "errcode": -3,
     *    "errmsg": "服务器忙，请稍后再尝试"
     *    }
     */
    public function actionRechangeAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(null, $form);
        $params = $this->handleForm($form);
        $serviceParams['sms_package_id'] = $params['id'];
        $serviceParams['shop_id'] = $this->_shop['id'];
        $serviceParams['shop_manager_id'] = $this->_shopManager['id'];
        $serviceParams['ip'] = empty($_SERVER['REMOTE_ADDR'])?'0.0.0.0':$_SERVER['REMOTE_ADDR'];
        $this->smsService->rechangeByWx($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->smsService->getError())) {
            return $this->setError($this->smsService->getError());
        }
        $data = 'http://'.PC_SITE.'/qrcode/image?url='.$this->smsService->_data;
        $this->setResult($data);
    }


    /**
     * @api {post} /sms/receive-ajax 06.领取短信赠送礼包
     * @apiName receive-ajax
     * @apiGroup Sms
     *
     * @apiParam {Number} id 短信赠送礼包ID
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Array}  errmsg.data 列表数据
     * @apiSuccess {Number} errmsg.data.created 创建时间
     * @apiSuccess {Number} errmsg.data.gift_sms_num 充值或赠送套餐赠送的短信条数
     * @apiSuccess {Number} errmsg.data.id 表ID
     * @apiSuccess {Number} errmsg.data.modified 最后修改时间
     * @apiSuccess {String} errmsg.data.order_no 订单单号
     * @apiSuccess {Number} errmsg.data.recharge_money 充值金额
     * @apiSuccess {Number} errmsg.data.recharge_sms_num 充值送短信条数
     * @apiSuccess {Number} errmsg.data.recharge_type 1微信充值 2系统赠送
     * @apiSuccess {Number} errmsg.data.shop_id 总店ID
     * @apiSuccess {Number} errmsg.data.shop_manager_id 操作员ID
     * @apiSuccess {Number} errmsg.data.sms_package_id 短信套餐表ID
     * @apiSuccess {Number} errmsg.data.status 订单状态 1未支付 2成功支付或领取
     *
     * @apiSuccessExample Success-Response:
     * {
     * "errcode": 0,
     * "errmsg": {
     *          "data":
     *              {
     *                  "created": 1462325375,
     *                  "gift_sms_num": 100,
     *                  "id": 2,
     *                  "modified": 1462325375,
     *                  "order_no": "SMS2016050514342804994",
     *                  "recharge_money": 100,
     *                  "recharge_sms_num": 2,
     *                  "recharge_type": 1,
     *                  "shop_id": 30,
     *                  "shop_manager_id": null,
     *                  "sms_package_id": 3,
     *                  "status": 2
     *              }
     *      }
     * }
     *
     * @apiErrorExample Error-Response:
     *    {
     *    "errcode": -3,
     *    "errmsg": "服务器忙，请稍后再尝试"
     *    }
     */
    public function actionReceiveAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        // form处理
        $form = new GeneralForm();
        $this->checkForm(null, $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id'],
        ];
        $this->smsService->smsReceive($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->smsService->getError())) {
            return $this->setError($this->smsService->getError());
        }
        $this->setResult($this->smsService->_data);
    }

}