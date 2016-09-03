<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 10:50
 */

namespace common\services\activity;

use common\cache\BaseCache;
use common\cache\WechatCache;
use common\models\Activity;
use common\models\CardCoupon;
use common\models\Terminal;
use common\services\BaseService;
use common\services\wechat\WechatPushService;
use common\vendor\wechat\wechat_sdk\ErrCode;
use common\vendor\wechat\wechat_sdk\Wechat;
use common\vendor\wechat\WechatCard;

class CardCouponService extends BaseService
{
    protected $cardCouponModel;
    protected $wxInfo = null;

    function __construct($wxInfo = null)
    {
        parent::__construct();
        $this->wxInfo = $wxInfo;
        $this->cardCouponModel = new CardCoupon();
    }

    /**
     * 创建卡券
     * @param $params
     */
    public function create($params)
    {
        if (($params['date_info_type'] == CardCoupon::DATE_INFO_TYPE_FIX_DATE) && ($params['begin'] == $params['end'])) {
            return $this->setError('卡券使用期限开始和结束时间不能为同一天');
        }
        //1.处理门店 判断是无门店限制还是指定门店
        $this->_getShopRange($params);
        $params['stock'] = $params['quantity']; //初始库存等于卡券设置数量
        //deal_detail 由前端合成
        //$params['deal_detail'] = '价值' . $params['card_money'] / 100 . '元代金券1张，满' . $params['money_limit'] / 100 . '元可使用';
        BaseCache::append('test_cache', __FILE__ . '_____' . __LINE__);
        BaseCache::append('test_cache', json_encode($params));
        //2.请求商户接口
        $this->cardCouponModel->create($params);
        // 接收数据层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        $this->setResult($this->cardCouponModel->_data);

        /* TODO 添加微信卡券功能放到接口处理了
         * $addReturnCardData = $this->cardCouponModel->_data;
        //3.同步微信卡券
        if (isset($params['card_type']) && $params['card_type'] == CardCoupon::CARD_TYPE_WEIXIN) {
            $releaseresult = $this->_cardRelease($params); //微信卡券发布
            if ($releaseresult == false) {
                //微信同步失败，执行硬删除卡券
                $this->cardCouponModel->hardDelete($addReturnCardData);
                if (!is_null($this->cardCouponModel->getError())) {
                    return $this->setError($this->cardCouponModel->getError());
                }
                return $this->setError('微信同步失败！');
            }
            $addReturnCardData['deleted'] = Activity::STATUS_ENABLE; //开启
            $addReturnCardData['wx_card_id'] = $releaseresult; //返回的卡券ID
            $addReturnCardData['examine_type'] = CardCoupon::EXAMINE_TYPE_VERIFY; //审核中

            //请求更新卡券信息接口
            $this->cardCouponModel->update($addReturnCardData);
            if (!is_null($this->cardCouponModel->getError())) {
                return $this->setError($this->cardCouponModel->getError());
            }
        }
        $this->setResult($this->cardCouponModel->_data);*/
    }

    /**
     * 编辑卡券
     * @param $params
     */
    public function update($params)
    {
        //1.处理门店 判断是无门店限制还是指定门店
        $this->_getShopRange($params);

        //2.同步微信卡券
        /*if (isset($params['card_type']) && $params['card_type'] == CardCoupon::CARD_TYPE_WEIXIN) {
            $releaseresult = $this->_cardRelease($params, true); //微信卡券发布
            BaseCache::append('test_cache', __FILE__ . '_____' . __LINE__);
            BaseCache::append('test_cache', $releaseresult);
            if ($releaseresult == false) {
                BaseCache::append('test_cache', __FILE__ . '_____' . __LINE__);
                return $this->setError('微信同步失败！');
            }
        }*/
        $this->cardCouponModel->update($params);
        // 接收数据层处理结果
        if (!is_null($this->cardCouponModel->getError())) {
            return $this->setError($this->cardCouponModel->getError());
        }
        $this->setResult($this->cardCouponModel->_data);
    }

    /**
     * 门店处理 判断是无门店限制还是指定门店
     * @param $params
     */
    protected function _getShopRange(&$params)
    {
        //assign -1 门店通用
        if (isset($params['assign']) && $params['assign'] != -1) {
            if (isset($params['range'])) {
                $store_str = '';
                $params['rangeArr'] = $params['range']; //后面同步微信卡券时要用到数组形式的门店范围
                foreach ($params['range'] as $key => $value) {
                    $store_str .= $value . ',';
                }
                $store_str = trim($store_str, ',');
            }
            $params['range'] = empty($store_str) ? "" : ',' .$store_str. ','; //无指定门店默认为空
        } else {
            $params['range'] = '';
        }
        if(empty($params['range'])){
           $params['rangeNullFlag'] = true;
        }
    }

    /**
     * 同步到微信卡券
     * @param $params
     */
    protected function _cardRelease($params, $is_update = false)
    {
        //1.获取卡券颜色
        $color = $this->cardCouponModel->cardColor($params['color']);
        $store_arr = []; //存储微信门店poi_id
        //2.获取卡券门店
        if (isset($params['rangeArr'])) {
            $store_arr = $this->getPois($params['rangeArr']);
        }
        //3.是否可赠送
        if (!isset($params['can_give_friend']) || $params['can_give_friend'] != CardCoupon::CAN_GIVE_FRIEND_TURE) {
            $can_give_friend = false;
        } else {
            $can_give_friend = true;
        }

        $extendParams = [
            'color' => $color,
            'store_arr' => count($store_arr) ? $store_arr : '',
            'code_type' => array_search($params['code_type'], $this->cardCouponModel->codeType), //微信端的卡券code类型
            'can_give_friend' => $can_give_friend,
            'card_type' => array_search($params['wx_card_type'], $this->cardCouponModel->wxCardType) //微信端的卡券类型字符标识
        ];
        BaseCache::append('test_cache', __FILE__ . '_____' . __LINE__);
        //4.卡券新增/编辑处理
        return $this->_dealCard($params, $extendParams, $is_update);
    }

    /**
     * @param $subIds
     * @return array
     */
    public function getPois($subIds){
        $store_arr = [];
        //查找门店，获取其中的poi_id
        $terminalModel = new Terminal();
        $condition = [
            'shop_id' => $this->_shopId,
            //TODO 接口通了再调试，微信门店不存在的情况下，知道门店使用会不会创建卡券不成功
            'available_status' => Terminal::AVAILABLE_STATUS_SYNCHRONIZING_SUCCESS,
            'ids' => $subIds //接口提供ids查询 数组
        ];
        $terminalModel->find($condition);
        if (!is_null($terminalModel->getError())) {
            $this->setError($terminalModel->getError());
        }
        foreach ($terminalModel->_data as $val) {
            if ($val['shopInfo']['poi_id']) {
                $store_arr[] = $val['shopInfo']['poi_id'];
            }
        }
        return $store_arr;
    }

    /**
     * 卡券新增/编辑处理
     * @param $data
     * @param $extends
     * @return bool
     */
    protected function _dealCard($data, $extends, $is_update)
    {
        $params = $this->cardCouponModel->getBaseInfo($data, $extends);
        $card_txt = strtolower($extends['card_type']); //卡券类型转小写

        if($is_update){ //编辑微信卡券
            $result = $this->getCardApi('updateCard', $params);

            return $result ? $result : false;
        }

        //仅添加才有
        switch ($data['wx_card_type']) {
            //代金券额外字段
            case CardCoupon::WX_CARD_TYPE_CACH:
                $params['card'][$card_txt]['least_cost'] = $data['money_limit'];
                $params['card'][$card_txt]['reduce_cost'] = $data['card_money'];
                break;
            //折扣券额外字段
            case CardCoupon::WX_CARD_TYPE_DISCOUNT:
                $params['card'][$card_txt]['discount'] = $data['card_discount'];
                break;
            //代金券额外字段
            case CardCoupon::WX_CARD_TYPE_GIFT:
                $params['card'][$card_txt]['gift'] = $data['exchange_content_text'];
                break;
            default:
                break;
        }
        //新增微信卡券
        $result = $this->getCardApi('createCard', $params);
        BaseCache::append('test_cache', '卡券内容：' . json_encode($result));
        if ($result && $result['errcode'] == 0 && $result['errmsg'] == 'ok') {
            return $result['card_id'];
        }

        return false;
    }

    /**
     * 判断微信公众号是否开启卡券功能
     * 通过获取卡券颜色为例
     * @param $wxInfo
     * @return bool
     */
    public function isOpenCardFunction()
    {
        BaseCache::append('test_cache', __FILE__ . '_____' . __LINE__);
        $result = $this->getCardApi('getCardColors');
        BaseCache::append('test_cache', json_encode($result));
        if ($result['errcode'] == 0 && $result['errmsg'] == 'ok') {
            //商家已开启MP后台卡券功能
            return true;
        } else {
            //商家未开启MP后台卡券功能
            return false;
        }
    }

    /**
     * @param type $action 方法名
     * @param type $data 数据
     * @return boolean
     */
    public function getCardApi($action, $data = '')
    {
        BaseCache::append('test_cache', __FILE__ . '_____' . __LINE__);
        //实例化微信接口
        $wxObj = new WechatCard(array(
            'token' => $this->wxInfo['token'],
            'appid' => $this->wxInfo['appid'],
            'secret' => $this->wxInfo['secret']
        ));
        BaseCache::append('test_cache', '微信配置'. json_encode($this->wxInfo));

        //如果token失效，清除token重试一次
        $flag = true;
        $i = 0;
        while($flag){
            BaseCache::append('test_cache', __FILE__ . '_____' . __LINE__);
            if (isset($data) && !empty($data)) {
                BaseCache::append('test_cache', __FILE__ . '_____' . __LINE__);
                BaseCache::append('test_cache', $data);
                $result = $wxObj->$action($data);
                BaseCache::append('test_cache', '---result--'.json_encode($result));
            } else {
                BaseCache::append('test_cache', __FILE__ . '_____' . __LINE__);
                $result = $wxObj->$action();
                BaseCache::append('test_cache', '---result--'.json_encode($result));
            }
            BaseCache::append('test_cache', $wxObj->getErrCode());
            if ($i<1 && !$result && ($wxObj->getErrCode() == 40001 || $wxObj->getErrCode() == 42001)) {
                BaseCache::append('test_cache', __FILE__ . '_____' . __LINE__);
                WechatCache::delToken($this->wxInfo['appid'], $this->wxInfo['secret']);
            }else{
                $flag = false;
            }
            $i++;
        }
        //如果返回false，获取errcode和errmsg
        BaseCache::append('test_cache', __FILE__ . '_____' . __LINE__);
        if (!$result) {
            $SaveArr['CardLog']['content'] = '错误码:' . $wxObj->getErrCode() . '错误内容:' . ErrCode::getErrText($wxObj->getErrCode());
            $SaveArr['CardLog']['keyword'] = '卡券后台';
            $SaveArr['CardLog']['type'] = 1;//1：代表卡券
            BaseCache::append('test_cache', '请求接口名' . $action . '：' . json_encode($SaveArr));
            return false;
        }
        return $result;
    }

    /**
     * 订单选择可以卡券
     */
    public function findUserCardInfo($params){
        //卡券相关
        $cardParams = [
            'shop_id' => $this->wxInfo['shop_id'],
            'order_amount' => $params['order_amount'],
            'valid_time' => true,
            'to_user_id' => $params['user_id'],
            'status' => CardCoupon::STATUS_CARD_RECEIVE,
            'sortStr' => ['card_money' => 'asc', 'end_time' => 'asc']
        ];
        if(isset($params['order_id']) && $params['order_id']){
            $cardParams += [
                'order_id' => $params['order_id'],
                'page' => 0,
                'count' => 20//要求不分页，最多显示20条
            ];
            //去除order_amount，卡券是否能使用在baseapi统一判断
            unset($cardParams['order_amount']);
        }
        $this->cardCouponModel->findCardInfo($cardParams);
        return $this->cardCouponModel->_data;
    }

    /**
     * TODO 暂时没用 解码code
     * @param $params
     */
    public function decriptCode($params){
        BaseCache::append('test_cache', __FILE__ . '_____' . __LINE__);
        BaseCache::append('test_cache', $params);
        if(!isset($params['choose_card_info']) || !$params['choose_card_info']){
            return $this->setError('您提交的数据参数有误');
        }
        $card_info = json_decode($params['choose_card_info']);
        $encrypt_code = $card_info[0]->encrypt_code;
        $result = $this->getCardApi('decryptCardCode', $encrypt_code); //code解码
        if(!$result){
            return $this->setError('code解码失败！');
        }
        //获取卡券信息
        $cardParams = [
            'shop_id' => $this->wxInfo['shop_id'],
            'code' => $result['code'] //TODO code参数接口没提供
        ];
        $this->cardCouponModel->findCardInfo($cardParams);
        $ret = $this->cardCouponModel->_data && $this->cardCouponModel->_data['data']? $this->cardCouponModel->_data['data'][0] : null;
        if ($ret && $ret['money_limit'] <= $params['total_price']) {
            $this->setResult($ret);
        } else {
            return $this->setError('商品金额不符合该卡券消费金额限制！');
        }
    }

    /**
     * 订单满额赠送卡券
     * @param $params array 卡券info数组集合，[[cardInfo, cardTypeInfo], [cardInfo, cardTypeInfo]]
     * @param $ext[open_id: 用户open_id, wxInfo:商户微信配置, shopName: 商家名称]
     */
    public function sendCard($params, $ext){
        BaseCache::append('test_cache', __FILE__ . '_____' . __LINE__,3600,true);
        if(!is_array($params) || !count($params)){
            return false;
        }
        if(!isset($ext['wxInfo']) && !$this->wxInfo){
            return false;
        }elseif(isset($ext['wxInfo'])){
            $this->wxInfo = $ext['wxInfo'];
        }
        BaseCache::append('test_cache', __FILE__ . '_____' . __LINE__,3600,true);
        $wechatPush = new WechatPushService($this->wxInfo, $ext);
        foreach($params as $val){
            $extends = [
                'shopName' => $ext['shopName'], //商家名
                'card_type' => $val['cardInfo']['type'],
                'info_id' => $val['cardInfo']['id'],
            ];

            $wechatPush->sendCardCoupon($val['cardTypeInfo'], $extends);
        }
    }
}