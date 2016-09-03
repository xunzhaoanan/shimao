<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\newservices;


class Member extends BaseService
{

    const INTT_PROCESS_DONE = 6;

    /**
     * 全部商品参与会员折扣
     */
    const DISCOUNTED_ALL_PRODUCT = 1;
    /**
     * 部分商品参与会员折扣
     */
    const DISCOUNTED_PART_PRODUCT = 2;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取会员等级列表
     */
    public function findCardShopsub($params)
    {
        return $this->getResult('member-find-card-shopsub',$params);
    }

    /**
     * 获取会员列表
     */
    public function findMember($params)
    {
        $data = $this->getResult('member-find-member',$params);
        return $data;
    }

    /**
     * 获取会员列表
     */
    public function getLastCount($params)
    {
        $data = $this->getResult('member-get-last-count',$params);
        return $data;
    }

    /**
     * 获取会员
     */
    public function getMember($params)
    {
        $data = $this->getResult('member-get-member',$params);
        return $data;
    }

    /**
     * 发送手机验证码
     */
    public function sendMobileCode($params){
        $data = $this->getResult('member-send-mobile-code',$params);
        return $data;
    }

    /**
     * 激活会员
     */
    public function activateMember($params)
    {
        $data = $this->getResult('member-activate-member',$params);
        return $data;
    }

    /**
     * 修改会员
     */
    public function updateMember($params)
    {
        $data = $this->getResult('member-update-member',$params);
        return $data;
    }

    /**
     * 修改用户
     */
    public function updateUser($params)
    {
        $data = $this->getResult('member-update-user',$params);
        return $data;
    }

    /**
     * 获取会员标签
     */
    public function getMemberTag($params)
    {
        $data = $this->getResult('member-get-member-tag',$params);
        return $data;
    }

    /**
     * 获取会员消费金额区间
     */
    public function findMemberCostSectionData($params)
    {
        $data = $this->getResult('member-find-member-cost-section-data',$params);
        return $data;
    }

    /**
     * 获取会员消费次数区间
     */
    public function findMemberCostCountData($params)
    {
        $data = $this->getResult('member-find-member-cost-count-data',$params);
        return $data;
    }

    /**
     * 获取每日会员数据
     */
    public function findMemberCountData($params)
    {
        $data = $this->getResult('member-find-member-count-data',$params);
        return $data;
    }

    /**
     * 获取激活卡每日数据
     */
    public function findMemberCardData($params)
    {
        $data = $this->getResult('member-find-member-card-data',$params);
        return $data;
    }

    /**
     * 获取商家会员设置
     */
    public function getShopMemberSetting($params)
    {
        $data = $this->getResult('member-get-shop-member-setting',$params);
        return $data;
    }

    /**
     * 会员同步微信会员卡
     */
    public function syncWxCard($params)
    {
        $data = $this->getResult('member-sync-wx-card',$params);
        return $data;
    }



    /**
     * 修改商家会员设置
     */
    public function updateShopMemberSetting($params)
    {
        $data = $this->getResult('member-update-shop-member-setting',$params);
        return $data;
    }

    /**
     * 获取成长值赠送设置
     */
    public function getGrowthSetting($params)
    {
        $data = $this->getResult('member-get-growth-setting',$params);
        return $data;
    }

    /**
     * 修改成长值赠送设置
     */
    public function updateGrowthSetting($params)
    {
        $data = $this->getResult('member-update-growth-setting',$params);
        return $data;
    }

    /**
     * 初始化会员卡
     */
    public function initCard($params)
    {
        $data = $this->getResult('member-init-card',$params);
        return $data;
    }

    /**
     * 获取会员卡信息
     */
    public function getCard($params)
    {
        $data = $this->getResult('member-get-card',$params);
        return $data;
    }

    /**
     * 获取会员卡信息
     */
    public function getWxCard($params)
    {
        $data = $this->getResult('member-get-wxcard',$params);
        return $data;
    }

    /**
     * 访问会员卡信息
     */
    public function accessCard($params)
    {
        $this->postData('member-access-card',$params);
    }

    /**
     * 修改会员卡信息
     */
    public function updateCard($params)
    {
        $data = $this->getResult('member-update-card',$params);
        return $data;
    }

    /**
     * 同步卡券到微信
     */
    public function syncCard($params)
    {
        $data = $this->getResult('member-sync-wx-card',$params);
        return $data;
    }

    /**
     * 同步商家会员卡到微信
     */
    public function shopSyncCard($params)
    {
        $data = $this->getResult('member-sync-card',$params);
        return $data;
    }

    /**
     * 同步会员数据到微信会员卡券
     */
    public function syncMemberDataToWx($params,$killThread = true)
    {
        $data = $this->getResult('member-sync-member-data-to-wx',$params,$killThread);
        return $data;
    }

    /**
     * 获取会员卡激活信息
     */
    public function getCardActivate($params)
    {
        $data = $this->getResult('member-get-card-activate',$params);
        return $data;
    }

    /**
     * 修改会员图文
     */
    public function updateCardShareMessage($params)
    {
        $data = $this->getResult('member-update-card-share-message',$params);
        return $data;
    }

    /**
     * 修改会员卡激活信息
     */
    public function updateCardActivate($params)
    {
        $data = $this->getResult('member-update-card-activate',$params);
        return $data;
    }

    /**
     * 修改微信会员卡审核状态
     */
    public function updateCardExamine($params)
    {
        $this->postData('member-update-card-examine',$params);
    }

    /**
     * 获取会员标签
     */
    public function getTag($params)
    {
        $data = $this->getResult('member-get-tag',$params);
        return $data;
    }

    /**
     * 获取会员标签
     */
    public function updateTag($params)
    {
        return $this->getResult('member-update-tag',$params);
    }

    /**
     * 获取会员标签列表
     */
    public function findTag($params)
    {
        return $this->getResult('member-find-tag',$params);
    }

    /**
     * 获取全部会员标签
     */
    public function findAllTag($params)
    {
        return $this->getResult('member-find-all-tag',$params);
    }

    /**
     * 删除会员标签
     */
    public function deleteTag($params)
    {
        return $this->getResult('member-delete-tag',$params);
    }

    /**
     * 创建会员标签
     */
    public function createTag($params)
    {
        return $this->getResult('member-create-tag',$params);
    }

    /**
     * 初始化会员分组
     */
    public function initGroup($params)
    {
        $data = $this->getResult('member-init-group',$params);
        return $data;
    }

    /**
     * 获取会员分组
     */
    public function getGroup($params)
    {
        $data = $this->getResult('member-get-group',$params);
        return $data;
    }

    /**
     * 获取会员分组
     */
    public function updateGroup($params)
    {
        return $this->getResult('member-update-group',$params);
    }

    /**
     * 获取会员分组列表
     */
    public function findGroup($params)
    {
        return $this->getResult('member-find-group',$params);
    }

    /**
     * 获取全部会员分组
     */
    public function findAllGroup($params)
    {
        return $this->getResult('member-find-all-group',$params);
    }

    /**
     * 删除会员分组
     */
    public function deleteGroup($params)
    {
        return $this->getResult('member-delete-group',$params);
    }

    /**
     * 创建定时任务数据
     */
    public function createConsoleData($params)
    {
        return $this->getResult('member-create-console-data',$params);
    }

    /**
     * 创建会员分组
     */
    public function createGroup($params)
    {
        return $this->getResult('member-create-group',$params);
    }

    /**
     * 初始化会员等级
     */
    public function initGrade($params)
    {
        $data = $this->getResult('member-init-grade',$params);
        return $data;
    }

    /**
     * 初始化开卡优惠
     */
    public function initGift($params)
    {
        $data = $this->getResult('member-init-gift',$params);
        return $data;
    }

    /**
     * 成长值初始化
     */
    public function initGrowth($params)
    {
        $data = $this->getResult('member-init-growth',$params);
        return $data;
    }

    /**
     * 通知初始化
     */
    public function initNotice($params)
    {
        $data = $this->getResult('member-init-notice',$params);
        return $data;
    }

    /**
     * 折扣初始化
     */
    public function initDiscount($params)
    {
        $data = $this->getResult('member-init-discount',$params);
        return $data;
    }

    /**
     * 获取会员等级
     */
    public function getGrade($params)
    {
        $data = $this->getResult('member-get-grade',$params);
        return $data;
    }

    /**
     * 获取会员等级
     */
    public function updateGrade($params)
    {
        return $this->getResult('member-update-grade',$params);
    }

    /**
     * 获取会员等级列表
     */
    public function findGrade($params)
    {
        return $this->getResult('member-find-grade',$params);
    }

    /**
     * 删除会员等级
     */
    public function deleteGrade($params)
    {
        return $this->getResult('member-delete-grade',$params);
    }

    /**
     * 创建会员等级
     */
    public function createGrade($params)
    {
        return $this->getResult('member-create-grade',$params);
    }

    /**
     * 创建会员打折商品&折扣类型设置
     * @param $params
     * @return mixed
     */
    public function createMemberDiscountedProduct($params)
    {
        return $this->getResult('member/create-member-discounted-product',$params);
    }

    /**
     * 折扣商品列表获取
     * @param $params
     * @return mixed
     */
    public function findMemberDiscountedProduct($params)
    {
        return $this->getResult('member/find-member-discounted-product',$params);
    }

    /**
     * 会员订单列表获取
     * @param $params
     * @return mixed
     */
    public function findMemberOrderList($params)
    {
        $data =  $this->getResult('order/find-member-order-list',$params);
        $data['all_member_payed'] = $data['data']['all_member_payed'];
        unset($data['data']['all_member_payed']);
        return $data;
    }

    /**
     * 消费金额分层统计
     * @param $params
     * @return mixed
     */
    public function statisticsMemberPayed($params)
    {
        return $this->getResult('statistics/statistics-user-by-should-pay',$params);
    }

    /**
     * 消费次数分层统计
     * @param $params
     * @return mixed
     */
    public function statisticsMemberOrderCount($params)
    {
        return $this->getResult('statistics/statistics-user-by-order-count',$params);
    }
}