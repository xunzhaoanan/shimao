<?php
/**
 * Author: LiuPing
 * Date: 2016/05/16
 * Time: 14:19
 */
namespace common\newservices;


class Reduction extends BaseService
{
    /**
     * 商品是否关联所有 1：关联所有  2：指定关联
     */
    const IS_RELATE_ALL_YES = 1;
    const IS_RELATE_ALL_NO = 2;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取满减活动列表
     */
    public function findReduction($params)
    {
        return $this->getResult('reduction-find', $params);
    }

    /**
     * 获取满减活动列表
     */
    public function getReduction($params)
    {
        return $this->getResult('reduction-get', $params);
    }

    /**
     * 添加满减活动
     */
    public function createReduction($params)
    {
        return $this->getResult('reduction-create', $params);
    }

    /**
     * 修改满减活动
     */
    public function updateReduction($params)
    {
        return $this->getResult('reduction-update', $params);
    }

    /**
     * 修改活动条件和策略
     */
    public function updateConditions($params)
    {
        return $this->getResult('reduction-conditions-update', $params);
    }

    /**
     * 删除活动商品
     */
    public function deleteReductionProduct($params)
    {
        return $this->getResult('reduction-product-del', $params);
    }

    /**
     * 添加活动商品
     */
    public function createReductionProduct($params)
    {
        return $this->getResult('reduction-product-create', $params);
    }

    /**
     * 添加活动商品
     */
    public function createReductionProductList($params)
    {
        return $this->getResult('reduction-product-list-create', $params);
    }

    /**
     * 获取活动商品列表
     */
    public function findReductionProduct($params)
    {
        return $this->getResult('reduction-product-find', $params);
    }

    /**
     * 启用满减活动
     */
    public function openReduction($params)
    {
        return $this->getResult('reduction-open', $params);
    }

    /**
     * 禁用满减活动
     */
    public function closeReduction($params)
    {
        return $this->getResult('reduction-close', $params);
    }

    /**
     * 删除满减活动
     */
    public function deleteReduction($params)
    {
        return $this->getResult('reduction-delete', $params);
    }

    /**
     * 订单商品可用满减活动
     */
    public function applyReductionList($params)
    {
        return $this->getResult('reduction-apply-reduction', $params);
    }

    /**
     * 商品可用满减活动
     */
    public function findProductReductions($params)
    {
        return $this->getResult('reduction-find-product-reductions', $params);
    }

    /**
     * 商品可用满减活动
     */
    public function findSelectedProducts($params)
    {
        return $this->getResult('reduction-find-selected-products', $params);
    }
}