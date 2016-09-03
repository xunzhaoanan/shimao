<?php

namespace admin\controllers;

use common\forms\weixin\WxMsgTplDetailForm;
use common\forms\weixin\WxMsgTplCreateForm;
use common\forms\weixin\WxMsgTplUpdateForm;
use common\forms\weixin\WxMsgTplUpdateStatusForm;
use common\forms\weixin\WxMsgCreateDefaultStaffForm;
use common\services\weixin\WxMsgTplService;
use common\models\WxMsgTpl;
use Yii;
use yii\base\UserException;
use yii\web\NotFoundHttpException;
use common\forms\weixin\WxMsgTplGetMessageIdForm;
use common\forms\weixin\WxMsgTplGetDetailForm;
use common\forms\weixin\WxMsgGetListForm;
use agent\forms\GeneralForm;
use common\forms\weixin\WxMsgSetStateForm;
use common\forms\weixin\WxMsgUpdateForm;
use common\forms\weixin\WxMsgShopReceiveForm;
use common\forms\weixin\WxMsgGetShopReceiveForm;
use common\forms\weixin\WxGetReceiveListForm;


class WxMsgTplController extends BaseController
{

    protected $wxMsgTplService;

    function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->wxMsgTplService = new WxMsgTplService();
    }

    /**
     * 买家模板首页
     */
    public function actionBuyerIndex()
    {
        return $this->render('buyer-index');
    }

    /**
     * 买家模板操作手册
     */
    public function actionTmpHelp()
    {
        return $this->render('tmp-help');
    }
  /**
   * 设置接收人员
   */
     public function actionRecipient()
     {
     return $this->render('recipient');
     }
    /**
     * 商家帐号绑定
     */
    public function actionAccountBound()
    {
        return $this->render('account-bound');
    }

    /**
     * 卖家模板首页
     */
    public function actionSellerIndex()
    {
        return $this->render('seller-index');
    }

    /**
     * 模板详情首页
     */
    public function actionDetail()
    {
        return $this->render('detail');
    }

    /**
     * 买家模板列表
     */
    public function actionGetBuyerTplList()
    {
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'to_user' => 1
        ];
        $this->getPageInfo($serviceParams);
        $this->wxMsgTplService->findMsgTpl($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }

        $this->setResult($this->wxMsgTplService->_data);
    }

    /**
     * @api {post} /wx-msg-tpl/get-seller-tpl-list 01.卖家已选模板列表
     * @apiName get-seller-tpl-list
     * @apiGroup WxMsgTpl
     *
     * @apiParam {Number} _page 选填,页码
     * @apiParam {Number} _page_size 选填,每页数据量
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Array}  errmsg.data 列表数据
     * @apiSuccess {Number} errmsg.data.0.id 模板id
     * @apiSuccess {Number} errmsg.data.0.template_id 关联id 无作用
     * @apiSuccess {String} errmsg.data.0.mp_id 微信公众平台模板ID
     * @apiSuccess {String} errmsg.data.0.header 模板title
     * @apiSuccess {String} errmsg.data.0.footer 模板结束语
     * @apiSuccess {String} errmsg.data.0.remark 使用备注
     * @apiSuccess {Number} errmsg.data.0.shop_id 总店ID
     * @apiSuccess {Number} errmsg.data.0.shop_sub_id 分店ID
     * @apiSuccess {Number} errmsg.data.0.to_staff_id 接收消息的员工id
     * @apiSuccess {Number} errmsg.data.0.failed_num 发送失败次数
     * @apiSuccess {Number} errmsg.data.0.failed_num 发送总次数
     * @apiSuccess {Number} errmsg.data.0.deleted 是否删除 1.启用、2.禁用、3.删除
     * @apiSuccess {timestamp} errmsg.data.0.created 创建时间
     * @apiSuccess {timestamp} errmsg.data.0.modified 最后更改时间
     * @apiSuccess {String} errmsg.data.0.name 模板名称
     * @apiSuccess {String} errmsg.data.0.no 模板编号
     * @apiSuccess {String} errmsg.data.0.body 模板示例内容
     * @apiSuccess {String} errmsg.data.0.tpl_remark 模板默认备注
     * @apiSuccess {Number} errmsg.data.0.status 总的模板开关 1.启用、2.禁用、3.删除
     *
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
     *              {
     *                  "id": "125",
     *                  "template_id": "18",
     *                  "mp_id": null,
     *                  "header": "您的店铺有一个退款申请，请及时处理",
     *                  "footer": "点击查看订单",
     *                  "remark": "用户发起退款申请时，通知我",
     *                  "shop_id": "30",
     *                  "shop_sub_id": "0",
     *                  "to_staff_id": null,
     *                  "failed_num": "0",
     *                  "total_num": "0",
     *                  "deleted": "2",
     *                  "created": "1457318775",
     *                  "modified": "1457318775",
     *                  "name": "退款申请提醒",
     *                  "no": "TM00431",
     *                  "body": "退款金额：¥145.25<br />\r\n商品详情：七匹狼正品 牛皮男士钱包 真皮钱包<br />\r\n订单编号：546787944-55446467-544749",
     *                  "tpl_remark": "用户发起退款申请时，通知我",
     *                  "status": "1"
     *              }
     *          ],
     *          "page": {
     *              "per_page": 15,
     *              "total_count": 2,
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
    public function actionGetSellerTplList()
    {
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'to_user' => 2
        ];
        $this->getPageInfo($serviceParams);
        $this->wxMsgTplService->findMsgTpl($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }

        $this->setResult($this->wxMsgTplService->_data);
    }

    /**
     * 买家可选模板列表
     */
    public function actionGetBuyerOptionalTplList()
    {
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'to_user' => 1,
            'sortStr' => ['id' => 'asc']
        ];
        $this->getPageInfo($serviceParams);
        $this->wxMsgTplService->findOptionalMsgTpl($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }

        $this->setResult($this->wxMsgTplService->_data);
    }

    /**
     * 卖家可选模板列表
     */
    public function actionGetSellerOptionalTplList()
    {
        $serviceParams = [
            'shop_id' => $this->_shop['id'],
            'to_user' => 2
        ];
        $this->getPageInfo($serviceParams);
        $this->wxMsgTplService->findOptionalMsgTpl($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }

        $this->setResult($this->wxMsgTplService->_data);
    }


    /**
     * 获取模板详情
     */
    public function actionGetTplDetail()
    {
        // form处理
        $form = new WxMsgTplDetailForm();
        $this->checkForm(["WxMsgTplDetailForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMsgTplService->getMsgTplDetail($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }

        $this->setResult($this->wxMsgTplService->_data);
    }
    
    /**
     * 获取模板详情基本信息
     */
    public function actionGetDetail()
    {
        // form处理
        $form = new WxMsgTplGetDetailForm();
        $this->checkForm(["WxMsgTplGetDetailForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
        'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMsgTplService->getMsgDetail($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }
    
        $this->setResult($this->wxMsgTplService->_data);
    }

    /**
     * 添加模板
     */
    public function actionCreateTpl()
    {
        // form处理
        $form = new WxMsgTplCreateForm();
        $this->checkForm(["WxMsgTplCreateForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMsgTplService->create($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }

        $this->setResult($this->wxMsgTplService->_data);
    }


    /**
     * 更新模板开关
     */
    public function actionUpdateTplStatus()
    {
        // form处理
        $form = new WxMsgTplUpdateStatusForm();
        $this->checkForm(["WxMsgTplUpdateStatusForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMsgTplService->updateMsgTpl($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }

        $this->setResult($this->wxMsgTplService->_data);
    }

    /**
     * 更新模板
     */
    public function actionUpdateTpl()
    {
        // form处理
        $form = new WxMsgTplUpdateForm();
        $this->checkForm(["WxMsgTplUpdateForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMsgTplService->updateMsgTpl($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }

        $this->setResult($this->wxMsgTplService->_data);
    }

    /**
     * 卖家已选操作员列表
     */
    public function actionGetDefaultStaffList()
    {
        $serviceParams = [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($serviceParams);
        $this->wxMsgTplService->findDefaultStaffList($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }

        $this->setResult($this->wxMsgTplService->_data);
    }

    /**
     * 卖家可选操作员列表
     */
    public function actionGetOptionalDefaultStaffList()
    {
        $serviceParams = [
            'shop_id' => $this->_shop['id']
        ];
        $this->getPageInfo($serviceParams);
        $this->wxMsgTplService->findOptionalDefaultStaffList($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }

        $this->setResult($this->wxMsgTplService->_data);
    }

    /**
     * 卖家添加操作员
     */
    public function actionCreateDefaultStaff()
    {
        // form处理
        $form = new WxMsgCreateDefaultStaffForm();
        $this->checkForm(["WxMsgCreateDefaultStaffForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMsgTplService->createDefaultStaff($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }

        $this->setResult($this->wxMsgTplService->_data);
    }

    /**
     * 卖家修改操作员状态
     */
    public function actionUpdateDefaultStaffStatus()
    {
        // form处理
        $form = new WxMsgTplUpdateStatusForm();
        $this->checkForm(["WxMsgTplUpdateStatusForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMsgTplService->updateDefaultStaff($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }

        $this->setResult($this->wxMsgTplService->_data);
    }
    

    /**
     * @api {post} /wx-msg-tpl/get-messsage-id 01.获取模板id
     * @apiName get-messsage-id
     * @apiGroup wx-msg-tpl
     *
     * @apiParam {Number} no 模板标识号的no
     * 
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Array}  data
     * @apiSuccess {String} message_id 模板id
     * 
     * @apiSuccessExample Success-Response:
     *  {
     *     "errcode": 0,
     *     "errmsg": "ok",
     *     "data": {
     *       "message_id": "ATTJExMDbEQh0ZPzeytnJSXXvE_Umxm7Bo8P_ej7Cdo"
     *     }
     *   }
     */
    public function actionGetMessageId()
    {
        $form = new WxMsgTplGetMessageIdForm();
        $this->checkForm(["WxMsgTplGetMessageIdForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
            'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMsgTplService->getMessageId($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }
        
        $this->setResult($this->wxMsgTplService->_data);
    }
    
    /**
     * @api {post} /wx-msg-tpl/add-receive 02.添加商家消息的接收者
     * @apiName add-receive
     * @apiGroup wx-msg-tpl
     * 
     * @apiParam {Number} id  必选,模板id
     * @apiParam {String} send_to_operator 是否发给操作者 1:是 2:否
     * @apiParam {String} send_to_staff 是否发给员工 1:是 2:否
     * @apiParam {String} send_to_belong_to_staff 是否发给归属员工 1:是 2:否
     * @apiParam {String} operator_ids 操作者id,多个用','隔开
     * @apiParam {String} staff_ids 员工id,多个用','隔开
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Array}  data
     * 
     *  @apiErrorExample Error-Response:
     * 
     *  {
     *     "errcode": 33002,
     *     "errmsg": "没有相关数据"
     *   }
     *   
     */
    public function actionAddReceive()
    {
        $form = new WxMsgShopReceiveForm();
        $this->checkForm(["WxMsgShopReceiveForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
        'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMsgTplService->addShopReceive($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }
        
        $this->setResult($this->wxMsgTplService->_data);
    }
    
    /**
     * @api {post} /wx-msg-tpl/set-receive 03.设置商家消息的接收者
     * @apiName set-receive
     * @apiGroup wx-msg-tpl
     *
     * @apiParam {Number} id  必选,模板id
     * @apiParam {String} send_to_operator 是否发给操作者 1:是 2:否
     * @apiParam {String} send_to_staff 是否发给员工 1:是 2:否
     * @apiParam {String} send_to_belong_to_staff 是否发给归属员工 1:是 2:否
     * @apiParam {String} operator_ids 操作者id,多个用','隔开
     * @apiParam {String} staff_ids 员工id,多个用','隔开
     * @apiParam {String} belong_to_staff_ids 归属员工id,多个用','隔开
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Array}  data
     * 
     *  @apiErrorExample Error-Response:
     * 
     *  {
     *     "errcode": 33002,
     *     "errmsg": "没有相关数据"
     *   }
     */
    public function actionSetReceive()
    {
        $form = new WxMsgShopReceiveForm();
        $this->checkForm(["WxMsgShopReceiveForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
        'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMsgTplService->setShopReceive($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }
        
        $this->setResult($this->wxMsgTplService->_data);
    }
    
    /**
     * @api {post} /wx-msg-tpl/delete-receive 04.删除商家消息的接收者
     * @apiName delete-receive
     * @apiGroup wx-msg-tpl
     *
     * @apiParam {Number} id  必选,模板id
     * @apiParam {String} operator_ids 操作者id,多个用','隔开
     * @apiParam {String} staff_ids 员工id,多个用','隔开
     * @apiParam {String} belong_to_staff_ids 归属员工id,多个用','隔开
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Array}  data
     * 
     * @apiErrorExample Error-Response:
     * 
     *  {
     *     "errcode": 33002,
     *     "errmsg": "没有相关数据"
     *   }
     *   
     */
    public function actionDeleteReceive()
    {
        $form = new WxMsgShopReceiveForm();
        $this->checkForm(["WxMsgShopReceiveForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
        'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMsgTplService->deleteShopReceive($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }
        
        $this->setResult($this->wxMsgTplService->_data);
    }
    
    /**
     * @api {post} /wx-msg-tpl/get-shop-receive 05.获取某个商家消息的接收者信息
     * @apiName get-shop-receive
     * @apiGroup wx-msg-tpl
     *
     * @apiParam {Number} id  必选,模板id
     * @apiParam {Number} type_id  必选,场景id
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Array}  data
     * 
     * @apiErrorExample Error-Response:
     * 
     *  {
     *     "errcode": 33002,
     *     "errmsg": "没有相关数据"
     *   }
     */
    public function actionGetShopReceive()
    {
        $form = new WxMsgGetShopReceiveForm();
        $this->checkForm(["WxMsgGetShopReceiveForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
        'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMsgTplService->getShopReceive($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }
        
        $this->setResult($this->wxMsgTplService->_data);
    }
    
    /**
     * @api {post} /wx-msg-tpl/get-msg-list-ajax 06.获取商家消息
     * @apiName get-msg-list-ajax
     * @apiGroup wx-msg-tpl
     *
     * @apiParam {Number} to_user  必选,1:买家消息 2:卖家消息
     * @apiParam {Number} module   2:会员消息
     * @apiParam {Number} _page   
     * @apiParam {Number} _page_size 
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Array}  data
     * @apiSuccess {Number}  id 消息id 为0时表示尚未配置过该消息
     * @apiSuccess {String}  name 场景名称
     * @apiSuccess {String}  remark 备注
     * @apiSuccess {Number}  deleted 场景消息是否可用 1:可用 2:不可用 
     * @apiSuccess {Number}  type_id 场景id
     * @apiSuccess {Number}  send_type 发送方式:1微商户,2微信
     * @apiSuccess {Number}  state 该消息当前状态 1:启用 2:禁用
     * 
     * @apiSuccessExample Success-Response:
     *   {
     *       "errcode": 0,
     *       "errmsg": {
     *           "data": [
     *               {
     *                   "type_id": "1",
     *                   "name": "订单创建成功通知",
     *                   "remark": "用户创建一个订单",
     *                   "deleted": "1",
     *                   "id": "120",
     *                   "send_type": 1,
     *                   "state": "1"
     *               },
     *               {
     *                   "type_id": "2",
     *                   "name": "订单关闭",
     *                   "remark": "1.用户未付款，手动关闭订单 2.用户未付款，超时后自动关闭订单 3.用户已付款，申请退款成功后关闭订单",
     *                   "deleted": "1",
     *                   "id": "0",
     *                   "send_type": "1",
     *                   "state": "2"
     *               },
     *               {
     *                   "type_id": "3",
     *                   "name": "商品支付成功通知",
     *                   "remark": "1.微信支付成功 2.线下支付成功",
     *                   "deleted": "1",
     *                   "id": "123",
     *                   "send_type": "2",
     *                   "state": "1"
     *               }
     *           ],
     *           "page": {
     *               "per_page": 20,
     *               "total_count": 22,
     *               "current_page": 0,
     *               "total_page": 2
     *           }
     *       }
     *   }     *   
     *   
     */
    public function actionGetMsgListAjax()
    {
        $form = new WxMsgGetListForm();
        $this->checkForm(["WxMsgGetListForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
        'shop_id' => $this->_shop['id'],
        'is_show' => 1,
        ];

//         //for test
//         $serviceParams = [
//         'to_user' => 1,
//         'shop_id' => $this->_shop['id'],        
//         ];
        $this->getPageInfo($serviceParams);
        // 调用逻辑层
        $this->wxMsgTplService->getMsgList($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }  
        $this->setResult($this->wxMsgTplService->_data);
    }
    
    
    /**
     * @api {post} /wx-msg-tpl/get-msg-detail 07.获取消息配置详情
     * @apiName get-msg-detail
     * @apiGroup wx-msg-tpl
     *
     * @apiParam {Number} id  必选,消息id
     * @apiParam {Number} type_id  必选,id消息类型
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Array}  data
     * @apiSuccess {Number}  id 消息id
     * @apiSuccess {String}  mp_id message_id
     * @apiSuccess {String}  remark 消息场景描述
     * @apiSuccess {String}  header 模版抬头
     * @apiSuccess {String}  footer 模板结语
     * @apiSuccess {String}  send_type 发送方式 1:微商户 2:微信
     * @apiSuccess {Object}  type 消息场景
     * @apiSuccess {String}  type.name 消息场景名称
     * @apiSuccess {String}  type.template_no 模板编码
     * @apiSuccess {String}  type.send_by_wx 是否可以通过微信发送 1:是 2:否
     * @apiSuccess {String}  type.send_by_wsh 是否可以通过微商户发送 1:是 2:否
     * @apiSuccess {String}  type.send_by_sms 是否可以通过短信发送 1:是 2:否
     * @apiSuccess {Object}  type.receiveSetting 商家信息接收者的设置(为商家消息时有用)
     * @apiSuccess {Object}  shopReceiver 已经设定的消息的接收者信息(为商家消息时有用)
     * 
     * 
     * @apiSuccessExample Success-Response:
     *   {
     *       "errcode": 0,
     *       "errmsg": "ok",
     *       "data": {
     *           "id": "118",
     *           "template_id": "19",
     *           "mp_id": "12312",
     *           "header": "",
     *           "footer": "",
     *           "remark": "用户集赞任务完成后，通知用户",
     *           "shop_id": "30",
     *           "shop_sub_id": "0",
     *           "to_staff_id": null,
     *           "failed_num": "0",
     *           "total_num": "0",
     *           "deleted": "1",
     *           "created": "1450423881",
     *           "modified": "1460007289",
     *           "type_id": "21",
     *           "send_type": "1",
     *           "type": {
     *               "id": "21",
     *               "name": "中奖结果通知",
     *               "ctrl": "",
     *               "action": "collect_click_done",
     *               "remark": "用户集赞完成后，通知用户",
     *               "template_name": "",
     *               "template_no": "",
     *               "header": "",
     *               "footer": "",
     *               "body_params": "",
     *               "body": "",
     *               "content_key": "",
     *               "send_by_wx": "1",
     *               "send_by_wsh": "1",
     *               "send_by_sms": "2",
     *               "callback_url": "",
     *               "deleted": "1",
     *               "created": "1449456334",
     *               "modified": "1450148732",
     *               "to_user": "1",
     *               "receiveSetting": []
     *           },
     *           "shopReceiver": []
     *       }
     *   }
     *   
     * @apiErrorExample Error-Response:
     *  {
     *     "errcode": 33002,
     *     "errmsg": "没有相关数据"
     *  }
     *   
     */
    public function actionGetMsgDetail()
    {
        $form = new WxMsgTplGetDetailForm();
        $this->checkForm(["WxMsgTplGetDetailForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
        'shop_id' => $this->_shop['id']
        ];

//         //for test
//         $serviceParams = ['shop_id' => $this->_shop['id'],'type_id'=>21,'id'=>118];
        
        // 调用逻辑层
        $this->wxMsgTplService->getDetail($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }
        
        $this->setResult($this->wxMsgTplService->_data);
    }
    
    /**
     * @api {post} /wx-msg-tpl/set-state 08.设置消息状态
     * @apiName set-state
     * @apiGroup wx-msg-tpl
     *
     * @apiParam {Number} id  必选,消息id
     * @apiParam {Number} type_id  必选,场景id
     * @apiParam {Number} state  必选,1:开启 2:关闭
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Array}  data
     * @apiSuccess {String}  template_id 模板id
     * @apiSuccess {String}  mp_id 发送消息时需要的message_id
     * @apiSuccess {String}  header 抬头
     * @apiSuccess {String}  footer 结语
     * @apiSuccess {String}  remark 备注
     * @apiSuccess {Number}  failed_num 发送失败次数
     * @apiSuccess {Number}  total_num 发送成功次数
     * @apiSuccess {Number}  deleted 状态 1:启用 2:禁用
     * 
     * @apiSuccessExample Success-Response:
     * 
     *   {
     *     "errcode": 0,
     *     "errmsg": "ok",
     *     "data": {
     *       "id": 118,
     *       "template_id": 19,
     *       "mp_id": "12312",
     *       "header": "",
     *       "footer": "",
     *       "remark": "用户集赞任务完成后，通知用户",
     *       "shop_id": 30,
     *       "shop_sub_id": 0,
     *       "to_staff_id": null,
     *       "failed_num": 0,
     *       "total_num": 0,
     *       "deleted": 2,
     *       "created": 1450423881,
     *       "modified": 1460081922
     *     }
     *   }
     */
    public function actionSetState()
    {
        $form = new WxMsgSetStateForm();
        $this->checkForm(["WxMsgSetStateForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
        'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMsgTplService->setState($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }
    
        $this->setResult($this->wxMsgTplService->_data);
    }
    
    /**
     * @api {post} /wx-msg-tpl/update-msg 09.修改模板消息
     * @apiName update-msg
     * @apiGroup wx-msg-tpl
     *
     * @apiParam {Number} id  必选,消息id
     * @apiParam {Number} send_type  必选,发送方式:1微商户,2微信 0不发送
     * @apiParam {Number} type_id  必选,场景id
     * @apiParam {Number} send_by_sms  是否发送短信:1发送,2不发送
     * @apiParam {String} header  抬头
     * @apiParam {String} footer  结语
     * @apiParam {String} mp_id  获取的message_id
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Array}  data
     * 
     * @apiErrorExample Error-Response:
     * 
     *  {
     *     "errcode": 33002,
     *     "errmsg": "没有相关数据"
     *   }
     */
    public function actionUpdateMsg()
    {
        $form = new WxMsgUpdateForm();
        $this->checkForm(["WxMsgUpdateForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
        'shop_id' => $this->_shop['id']
        ];
        // 调用逻辑层
        $this->wxMsgTplService->updateMsg($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }    
        $this->setResult($this->wxMsgTplService->_data);
    }
    
    /**
     * @api {post} /wx-msg-tpl/get-shop-receive-list 10.获取所有可用的接收人员列表
     * @apiName get-shop-receive-list
     * @apiGroup wx-msg-tpl
     *
     * @apiParam {Number} type_id  必选,类型 1:操作员 2:员工 
     * @apiParam {Number} shop_sub_id  分店id
     * @apiParam {Number} agent_id  代理商id
     *
     * @apiSuccess {Number} errcode
     * @apiSuccess {Object} errmsg
     * @apiSuccess {Array}  data
     * @apiSuccess {String}  data._id 角色id
     * @apiSuccess {String}  data.name 角色名
     * @apiSuccess {Array}  data.children 员工
     * @apiSuccess {String}  data.children._id 员工id
     * @apiSuccess {String}  data.children.name 员工名
     * @apiSuccess {String}  data.children.role_name 员工角色名
     * @apiSuccess {String}  data.children.shop_name 店铺名
     * @apiSuccess {String}  data.children.agent_name 代理商名
     * @apiSuccess {String}  data.children.is_bind 微信绑定状态 1:已绑定 2:未绑定
     *
     * @apiSuccessExample Success-Response:
     * 
     *   {
     *       "errcode": 0,
     *       "errmsg": {
     *           "page": {
     *               "per_page": 20,
     *               "total_count": 22,
     *               "current_page": 0,
     *               "total_page": 2
     *           },
     *           "data": [
     *               {
     *                   "_id": 465,
     *                   "name": "哈哈",
     *                   "icon": "",
     *                   "children": [
     *                       {
     *                           "_id": 320,
     *                           "role_name":"哈哈",
     *                           "shop_name": "",
     *                           "agent_name": "",
     *                           "name": "晃啊晃",
     *                           "icon": "",
     *                           "is_bind": 2
     *                       }
     *                   ]
     *               },
     *               {
     *                   "_id": 479,
     *                   "name": "55",
     *                   "icon": "",
     *                   "children": [
     *                       {
     *                           "_id": 319,
     *                           "role_name":"55",
     *                           "name": "新的一天",
     *                           "icon": "",
     *                           "is_bind": 2
     *                       }
     *                   ]
     *               }
     *           ]
     *       }
     *   }
     *   
     * @apiErrorExample Error-Response:
     *
     *  {
     *     "errcode": 33002,
     *     "errmsg": "没有相关数据"
     *   }
     */
    public function actionGetShopReceiveList()
    {
        $form = new WxGetReceiveListForm();
        $this->checkForm(["WxGetReceiveListForm" => Yii::$app->request->post()], $form);
        $serviceParams = $this->handleForm($form);
        $serviceParams += [
        'shop_id' => $this->_shop['id']
        ];
//         // for test
//         $serviceParams = ['type_id'=>2,'shop_id'=>30];
        
        $this->getPageInfo($serviceParams);
        // 调用逻辑层
        $this->wxMsgTplService->getAllShopReceiveList($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($this->wxMsgTplService->getError())) {
            return $this->setError($this->wxMsgTplService->getError());
        }
        $this->setResult($this->wxMsgTplService->_data);
    }
    
    /**
     * @api {post} /wx-msg-tpl/get-add-shop-receive-qrcode 11.获取二维码
     * @apiName get-add-shop-receive-qrcode
     * @apiGroup wx-msg-tpl
     *
     * @apiParam {Number} id 消息id
     *
     * @apiSuccess {String} errmsg 二维码链接地址
     * 
     * @apiSuccessExample Success-Response:
     *
     *   {
     *       "errcode": 0,
     *       "errmsg": ''
}
     *   }
     */
    public function actionGetAddShopReceiveQrcode()
    {
        $form = new GeneralForm();
        $this->checkForm(["GeneralForm" => Yii::$app->request->post()], $form);  
        $serviceParams = $this->handleForm($form);
        $data = 'http://'.PC_SITE.'/qrcode/image?url='.getMobileSite().'/wx-message/bind-staff?id='.$serviceParams['id'];
        $this->setResult($data);
    }
}