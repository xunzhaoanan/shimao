<?php
/**
 * Author: LiuPing
 * Date: 2016/05/16
 * Time: 13:00
 */


namespace admin\controllers;

use common\helpers\CommonLib;
use common\helpers\YiiHelper;
use common\newforms\IdForm;
use common\newforms\reduction\CreateProductListForm;
use common\newforms\reduction\CreateReductionForm;
use common\newforms\reduction\CreateRProductsForm;
use common\newforms\reduction\DelRProductForm;
use common\newforms\reduction\UpdateConditionsForm;
use common\newforms\reduction\UpdateReductionForm;
use common\newservices\Reduction;
use common\services\CommonService;
use Yii;
use yii\base\UserException;
use yii\web\NotFoundHttpException;


class ReductionController extends NewBaseController
{

    protected $reduction;

    function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->reduction = new Reduction();
    }

    /**
     * 获取列表
     */
    public function actionList()
    {
        return $this->render('list');
    }

    /**
     * @api {post} /reduction/list-ajax 01.获取满减活动列表
     * @apiGroup Reduction
     * @apiVersion 0.4.7
     *
     * @apiSuccess {Number} errcode 0表示成功，其他则为异常
     * @apiSuccess {Array} errmsg.data  异常说明或成功时返回的数据（字段说明参照/reduction/detail-ajax）
     * @apiSuccess {Object} errmsg.page 页码数据
     * @apiSuccess {Number} errmsg.page.per_page 单页数据量
     * @apiSuccess {Number} errmsg.page.total_count 总数据量
     * @apiSuccess {Number} errmsg.page.current_page 当前页码
     * @apiSuccess {Number} errmsg.page.total_page 总页码
     *
     * @apiSuccessExample Success-Response:
     * {
     *      "errcode": 0,
     *      "errmsg": {}
     * }
     *
     * @apiErrorExample Error-Response:
     *    {
     *      "errcode": -3,
     *      "errmsg": "服务器忙，请稍后再尝试"
     *    }
     *
     */
    public function actionListAjax($params = [])
    {
        //参数格式化
        $params = $this->handleParams($params);
        $this->loadPageParams($params);
        //调用逻辑层，得到处理结果
        $data = $this->reduction->findReduction($params);
        //完成本次请求，并输出结果
        $this->setResult($data);
    }

    /**
     * 添加活动
     * @return string
     */
    public function actionAdd()
    {
        return $this->render('add');
    }

    /**
     * @api {post} /reduction/add-ajax 02.添加满减活动
     * @apiGroup Reduction
     * @apiVersion 0.4.7
     *
     * @apiParam {string} name 活动名称
     * @apiParam {number} is_relate_all 是否关联所有商品）1、是 2、否
     * @apiParam {number} start_time 活动开始时间
     * @apiParam {number} end_time 活动结束时间
     * @apiParam {array} conditions 活动条件（二维数组）
     * @apiParam {number} conditions.condition_type 优惠条件类型） 1、满X元 2、满X件
     * @apiParam {number} conditions.level 优惠条件层级
     * @apiParam {number} conditions.condition_min 优惠条件值
     * @apiParam {array} conditions.strategys 优惠设置（二维数组）
     * @apiParam {number} conditions.strategys.reduction_type 减免类型）1.金额 2.打折 3.积分、4.包邮、5.送卡券、6.送现金红包、7.送商城红包
     * @apiParam {number} conditions.strategys.discount 打折值
     * @apiParam {number} conditions.strategys.amount 优惠值设置
     * @apiParam {number} conditions.strategys.is_all_area 是否全国包邮）1、是 2、否
     * @apiParam {number} conditions.strategys.area_id 适用地区ID，比如：1(,2,)137(,138,)
     * @apiParam {number} conditions.strategys.area_cn area中文，比如：北京市省(,北京市,);天津市省(,天津市,);
     * @apiParam {number} conditions.strategys.is_limit 是否上不封顶）1、是 2、否
     * @apiParam {array} products 活动商品（二维数组）
     * @apiParam {number} products.product_id 商品id
     * @apiParam {number} product_sku_id skuid
     *
     */
    public function actionAddAjax()
    {
        //form校验参数
        $form = new CreateReductionForm();
        $params = $this->handleForm(["CreateReductionForm" => YiiHelper::getRequest()->post()], $form);
        //参数格式化
        $params = $this->handleParams($params);
        //调用逻辑层，得到处理结果
        $data = $this->reduction->createReduction($params);
        //完成本次请求，并输出结果
        $this->setResult($data);
    }

    /**
     * 编辑活动
     * @return string
     */
    public function actionEdit()
    {
        return $this->render('edit');
    }

    /**
     * @api {post} /reduction/detail-ajax 03.活动详情
     * @apiGroup Reduction
     * @apiVersion 0.4.7
     *
     * @apiParam {number} id 活动id
     *
     * @apiSuccess {Number} errcode 0表示成功，其他则为异常
     * @apiSuccess {Array} errmsg
     * @apiSuccess {String} errmsg.name 活动名称
     * @apiSuccess {Number} errmsg.is_relate_all 是否关联全部商品）1、是 2、否
     * @apiSuccess {Number} errmsg.start_time 活动开始时间
     * @apiSuccess {Number} errmsg.end_time 活动结束时间
     * @apiSuccess {Array} errmsg.conditions 层级优惠
     * @apiSuccess {Number} errmsg.conditions.condition_type 优惠条件类型 1、满X元 2、满X件
     * @apiSuccess {Number} errmsg.conditions.level 层级
     * @apiSuccess {Number} errmsg.conditions.condition_min 优惠值，比如满（X）元
     * @apiSuccess {Array} errmsg.conditions.strategys 策略信息
     * @apiSuccess {Number} errmsg.conditions.strategys.amount 减免金额
     * @apiSuccess {Number} errmsg.conditions.strategys.reduction_type 减免类型）1.金额 2.打折 3.积分、4.包邮、5.送卡券、6.送现金红包、7.送商城红包
     * @apiSuccess {Number} errmsg.conditions.strategys.point 积分
     * @apiSuccess {Number} errmsg.conditions.strategys.discount 折扣
     * @apiSuccess {Number} errmsg.conditions.strategys.reduction_type_id 赠送优惠ID(卡券、红包等)
     * @apiSuccess {Number} errmsg.conditions.strategys.is_all_area 是否全国包邮）1、是 2、否
     * @apiSuccess {String} errmsg.conditions.strategys.area_id 适用地区ID，比如：1(,2,)137(,138,)
     * @apiSuccess {String} errmsg.conditions.strategys.area_cn area中文，比如：北京市省(,北京市,);天津市省(,天津市,);
     * @apiSuccess {Number} errmsg.conditions.strategys.is_limit 是否上不封顶）1、是 2、否
     *
     *
     * @apiSuccessExample Success-Response:
     * {
     *      "errcode": 0,
     *      "errmsg": {}
     * }
     *
     * @apiErrorExample Error-Response:
     *    {
     *      "errcode": -3,
     *      "errmsg": "服务器忙，请稍后再尝试"
     *    }
     *
     *
     */
    public function actionDetailAjax()
    {
        //form校验参数
        $form = new IdForm();
        $params = $this->handleForm(["IdForm" => YiiHelper::getRequest()->post()], $form);
        //参数格式化
        $params = $this->handleParams($params);
        //调用逻辑层，得到处理结果
        $data = $this->reduction->getReduction($params);
        //完成本次请求，并输出结果
        $this->setResult($data);
    }

    /**
     * @api {post} /reduction/edit-ajax 03.编辑活动设置
     * @apiGroup Reduction
     * @apiVersion 0.4.7
     *
     * @apiParam {number} id 活动id
     * @apiParam {string} name 活动名称
     * @apiParam {number} is_relate_all 是否关联所有商品）1、是 2、否
     * @apiParam {number} start_time 活动开始时间
     * @apiParam {number} end_time 活动结束时间
     */
    public function actionEditAjax()
    {
        //form校验参数
        $form = new UpdateReductionForm();
        $params = $this->handleForm(["UpdateReductionForm" => YiiHelper::getRequest()->post()], $form);
        //参数格式化
        $params = $this->handleParams($params);
        //调用逻辑层，得到处理结果
        $data = $this->reduction->updateReduction($params);
        //完成本次请求，并输出结果
        $this->setResult($data);
    }

    /**
     * @api {post} /reduction/find-product-ajax 05.活动商品列表
     * @apiGroup Reduction
     * @apiVersion 0.4.7
     *
     * @apiParam {number} id 活动id
     * @apiParam {number} is_find_all 是否获取该活动所有商品列表 值为1
     * @apiParam {number} _page 当前页码
     * @apiParam {number} _page_size  每页条数
     *
     */
    public function actionFindProductAjax()
    {
        //form校验参数
        $form = new IdForm();
        $params = $this->handleForm(["IdForm" => YiiHelper::getRequest()->post()], $form, true); //第三参数 加载分页参数
        CommonLib::replaceParams($params, ['id' => 'reduction_id']);
        if (!YiiHelper::getRequest()->post('is_find_all')) {
            $this->loadPageParams($params);
        }
        //参数格式化
        $params = $this->handleParams($params);
        //调用逻辑层，得到处理结果
        $data = $this->reduction->findReductionProduct($params);
        //完成本次请求，并输出结果
        $this->setResult($data);
    }


    /**
     * @api {post} /reduction/edit-conditions-ajax 04.编辑活动策略
     * @apiGroup Reduction
     * @apiVersion 0.4.7
     *
     * @apiParam {number} id 优惠条件condition id
     * @apiParam {number} reduction_id 活动id
     * @apiParam {number} condition_type 优惠条件类型） 1、满X元 2、满X件
     * @apiParam {number} level 优惠条件层级
     * @apiParam {number} condition_min 优惠条件值
     * @apiParam {array} strategys 优惠设置（二维数组）
     * @apiParam {number} strategys.reduction_id 活动id
     * @apiParam {number} strategys.reduction_type 减免类型）1.金额 2.打折 3.积分、4.包邮、5.送卡券、6.送现金红包、7.送商城红包
     * @apiParam {number} strategys.discount 折扣设置
     * @apiParam {number} strategys.amount 优惠值设置
     * @apiParam {number} strategys.is_all_area 是否全国包邮）1、是 2、否
     * @apiParam {string} conditions.strategys.area_id 适用地区ID，比如：1(,2,)137(,138,)
     * @apiParam {string} conditions.strategys.area_cn area中文，比如：北京市省(,北京市,);天津市省(,天津市,);
     * @apiParam {number} conditions.strategys.is_limit 是否上不封顶）1、是 2、否
     *
     */
    public function actionEditConditionsAjax()
    {
        //form校验参数
        $form = new UpdateConditionsForm();
        $params = $this->handleForm(["UpdateConditionsForm" => YiiHelper::getRequest()->post()], $form);
        //参数格式化
        $params = $this->handleParams($params);
        //调用逻辑层，得到处理结果
        $data = $this->reduction->updateConditions($params);
        //完成本次请求，并输出结果
        $this->setResult($data);
    }

    /**
     * @api {post} /reduction/create-product-ajax 05.添加活动商品
     * @apiGroup Reduction
     * @apiVersion 0.4.7
     *
     * @apiParam {number} reduction_id 活动id
     * @apiParam {number} product_id 商品id
     * @apiParam {number} product_sku_id skuid
     *
     */
    public function actionCreateProductAjax()
    {
        //form校验参数
        $form = new CreateRProductsForm();
        $params = $this->handleForm(["CreateRProductsForm" => YiiHelper::getRequest()->post()], $form);
        //参数格式化
        $params = $this->handleParams($params);
        //调用逻辑层，得到处理结果
        $data = $this->reduction->createReductionProduct($params);
        //完成本次请求，并输出结果
        $this->setResult($data);
    }

    /**
     * @api {post} /reduction/create-product-list-ajax 05.批量关联活动商品
     * @apiGroup Reduction
     * @apiVersion 0.4.7
     *
     * @apiParam {number} reduction_id 活动id
     * @apiParam {array} products 商品集合
     * @apiParam {number} products.product_id 商品id
     * @apiParam {number} products.product_sku_id skuid
     *
     */
    public function actionCreateProductListAjax()
    {
        //form校验参数
        $form = new CreateProductListForm();
        $params = $this->handleForm(["CreateProductListForm" => YiiHelper::getRequest()->post()], $form);
        //参数格式化
        $params = $this->handleParams($params);
        //调用逻辑层，得到处理结果
        $data = $this->reduction->createReductionProductList($params);
        //完成本次请求，并输出结果
        $this->setResult($data);
    }

    /**
     * @api {post} /reduction/del-product-ajax 06.删除活动商品
     * @apiGroup Reduction
     * @apiVersion 0.4.7
     *
     * @apiParam {number} reduction_id 活动id
     * @apiParam {number} product_id 商品id
     * @apiParam {number} product_sku_id 商品id
     *
     */
    public function actionDeleteProductAjax()
    {
        //form校验参数
        $form = new DelRProductForm();
        $params = $this->handleForm(["DelRProductForm" => YiiHelper::getRequest()->post()], $form);
        //参数格式化
        $params = $this->handleParams($params);
        //调用逻辑层，得到处理结果
        $data = $this->reduction->deleteReductionProduct($params);
        //完成本次请求，并输出结果
        $this->setResult($data);
    }


    /**
     * @api {post} /reduction/open-ajax 07.启用满减活动
     * @apiGroup Reduction
     * @apiVersion 0.4.7
     *
     * @apiParam {number} id 活动id
     *
     * @apiSuccess {Number} errcode 0表示成功，其他则为异常
     *
     * @apiSuccessExample Success-Response:
     *   {
     *     "errcode": 0,
     *     "errmsg": {}
     *   }
     *
     * @apiErrorExample Error-Response:
     *    {
     *      "errcode": -3,
     *      "errmsg": "服务器忙，请稍后再尝试"
     *    }
     */
    public function actionOpenAjax()
    {
        //form校验参数
        $form = new IdForm();
        $params = $this->handleForm(["IdForm" => YiiHelper::getRequest()->post()], $form);
        //参数格式化
        $params = $this->handleParams($params);
        //调用逻辑层，得到处理结果
        $data = $this->reduction->openReduction($params);
        //完成本次请求，并输出结果
        $this->setResult($data);
    }

    /**
     * @api {post} /reduction/close-ajax 08.禁用满减活动
     * @apiGroup Reduction
     * @apiVersion 0.4.7
     *
     * @apiParam {number} id 活动id
     *
     * @apiSuccess {Number} errcode 0表示成功，其他则为异常
     *
     * @apiSuccessExample Success-Response:
     *   {
     *     "errcode": 0,
     *     "errmsg": {}
     *   }
     *
     * @apiErrorExample Error-Response:
     *    {
     *      "errcode": -3,
     *      "errmsg": "服务器忙，请稍后再尝试"
     *    }
     */
    public function actionCloseAjax()
    {
        //form校验参数
        $form = new IdForm();
        $params = $this->handleForm(["IdForm" => YiiHelper::getRequest()->post()], $form);
        //参数格式化
        $params = $this->handleParams($params);
        //调用逻辑层，得到处理结果
        $data = $this->reduction->closeReduction($params);
        //完成本次请求，并输出结果
        $this->setResult($data);
    }

    /**
     * @api {post} /reduction/delete-ajax 09.删除满减活动
     * @apiGroup Reduction
     * @apiVersion 0.4.7
     *
     * @apiParam {number} id 活动id
     *
     * @apiSuccess {Number} errcode 0表示成功，其他则为异常
     *
     * @apiSuccessExample Success-Response:
     *
     * {
     *      "errcode": 0,
     *      "errmsg": {}
     * }
     *
     * @apiErrorExample Error-Response:
     *    {
     *      "errcode": -3,
     *      "errmsg": "服务器忙，请稍后再尝试"
     *    }
     */
    public function actionDeleteAjax()
    {
        //form校验参数
        $form = new IdForm();
        $params = $this->handleForm(["IdForm" => YiiHelper::getRequest()->post()], $form);
        //参数格式化
        $params = $this->handleParams($params);
        //调用逻辑层，得到处理结果
        $data = $this->reduction->deleteReduction($params);
        //完成本次请求，并输出结果
        $this->setResult($data);
    }

    /**
     * @api {post} /reduction/find-selected-product-ajax 10.获取满减活动已被选中的商品
     * @apiGroup Reduction
     * @apiVersion 0.4.7
     *
     * @apiSuccess {Number} errcode 0表示成功，其他则为异常
     * @apiSuccess {Array} errmsg.data  异常说明或成功时返回的数据
     * @apiSuccess {Object} errmsg.page 页码数据
     * @apiSuccess {Number} errmsg.page.per_page 单页数据量
     * @apiSuccess {Number} errmsg.page.total_count 总数据量
     * @apiSuccess {Number} errmsg.page.current_page 当前页码
     * @apiSuccess {Number} errmsg.page.total_page 总页码
     *
     * @apiSuccessExample Success-Response:
     * {
     *      "errcode": 0,
     *      "errmsg": {}
     * }
     *
     * @apiErrorExample Error-Response:
     *    {
     *      "errcode": -3,
     *      "errmsg": "服务器忙，请稍后再尝试"
     *    }
     *
     */
    public function actionFindSelectedProductAjax($params = [])
    {
        //参数格式化
        $params = $this->handleParams($params);
        $this->loadPageParams($params);
        //调用逻辑层，得到处理结果
        $data = $this->reduction->findSelectedProducts($params);
        //完成本次请求，并输出结果
        $this->setResult($data);
    }
}