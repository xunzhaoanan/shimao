<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 14:05
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * SecondKill model
 */
class SecondKill extends BaseModel
{

    // 类缓存前缀
    const CACHE_KEY_PRE = 'models_secondkill_';


    /**
     * 获取秒杀活动列表
     */
    public function secondKillFind($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
            'share_type' => isset($params['share_type']) ? $params['share_type'] : null
        ];
        $this->getResult('second-kill-find', $apiParams);
    }

    /**
     * 获取秒杀活动信息
     */
    public function secondKillGet($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'activity_type' => isset($params['activity_type']) ? $params['activity_type'] : null,
            'relate_activity_type' => isset($params['relate_activity_type']) ? $params['relate_activity_type'] : null,
            'postage_setting_id' => isset($params['postage_setting_id']) ? $params['postage_setting_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'desc' => isset($params['desc']) ? $params['desc'] : null,
            'sort' => isset($params['sort']) ? $params['sort'] : null,
            'expire_type' => isset($params['expire_type']) ? $params['expire_type'] : null,
            'start_time' => isset($params['start_time']) ? $params['start_time'] : null,
            'end_time' => isset($params['end_time']) ? $params['end_time'] : null,
            'wx_qrcode_id' => isset($params['wx_qrcode_id']) ? $params['wx_qrcode_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('second-kill-get', $apiParams);
    }

    /**
     * 更新秒杀活动
     */
    public function secondKillUpdate($params)
    {
        $apiParams = [
            'activity' => [
                'id' => isset($params['activity']['id']) ? $params['activity']['id'] : null,
                'name' => isset($params['activity']['name']) ? $params['activity']['name'] : null,
                'desc' => isset($params['activity']['desc']) ? $params['activity']['desc'] : null,
                'sort' => isset($params['activity']['sort']) ? $params['activity']['sort'] : null,
                'activity_type' => isset($params['activity']['activity_type']) ? $params['activity']['activity_type'] : null,
                'start_time' => isset($params['activity']['start_time']) ? $params['activity']['start_time'] : null,
                'end_time' => isset($params['activity']['end_time']) ? $params['activity']['end_time'] : null,
                'shop_id' => isset($params['activity']['shop_id']) ? $params['activity']['shop_id'] : null,
                'shop_sub_id' => isset($params['activity']['shop_sub_id']) ? $params['activity']['shop_sub_id'] : null,
                'share_type' => isset($params['activity']['share_type']) ? $params['activity']['share_type'] : null
            ],

            'secondKill' => [
                'id' => isset($params['secondKill']['id']) ? $params['secondKill']['id'] : null
            ],
            'postageSetting' => [
                'type' => isset($params['postageSetting']['type']) ? $params['postageSetting']['type'] : null,
                'num' => isset($params['postageSetting']['num']) ? $params['postageSetting']['num'] : null,
                'amount' => isset($params['postageSetting']['amount']) ? $params['postageSetting']['amount'] : null,//数值以分为单位
            ],
            'shareMessage' => [
                'title' => isset($params['shareMessage']['title']) ? $params['shareMessage']['title'] : null,
                'desc' => isset($params['shareMessage']['desc']) ? $params['shareMessage']['desc'] : null,
                'pic_id' => isset($params['shareMessage']['pic_id']) ? $params['shareMessage']['pic_id'] : null,
            ],
            'news' => [
                'title' => isset($params['news']['title']) ? $params['news']['title'] : null,
                'description' => isset($params['news']['description']) ? $params['news']['description'] : null,
                'document_id' => isset($params['news']['document_id']) ? $params['news']['document_id'] : null,
                'content' => isset($params['news']['content']) ? $params['news']['content'] : null
            ]
        ];
        //去除空白数组
        array_remove_empty($apiParams);
        $this->getResult('second-kill-update', $apiParams);
    }

    /**
     * 开启活动
     * @param $params
     */
    public function secondKillOpen($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('second-kill-open', $apiParams);
    }

    /**
     * 关闭活动
     * @param $params
     */
    public function secondKillClose($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('second-kill-close', $apiParams);
    }

    /**
     * 查找活动下所有管理商品 返回活动信息和商品信息
     * @param $params
     */
    public function getSecondKillWithGoods($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('seckill-get-with-Goods', $apiParams);
    }

    /**
     * 删除活动
     * @param $params
     */
    public function secondKillDel($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('second-kill-del', $apiParams);
    }

    /**
     * 添加秒杀商品
     * @param $params
     */
    public function seckillGoodsCreate($params)
    {
        $apiParams = [
            'second_kill_id' => isset($params['second_kill_id']) ? $params['second_kill_id'] : null,
            'product_id' => isset($params['product_id']) ? $params['product_id'] : null,
            'product_sku_id' => isset($params['product_sku_id']) ? $params['product_sku_id'] : null,
            'product_name' => isset($params['product_name']) ? $params['product_name'] : null,
            'product_price' => isset($params['product_price']) ? $params['product_price'] : null,
            'buy_price' => isset($params['buy_price']) ? $params['buy_price'] : null,
            'quota' => isset($params['quota']) ? $params['quota'] : null,
            'limit_buy' => isset($params['limit_buy']) ? $params['limit_buy'] : null,
            'sales_num' => isset($params['sales_num']) ? $params['sales_num'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('seckill-goods-create', $apiParams);
    }

    /**
     * 获取秒杀商品列表
     * @param $params
     */
    public function seckillGoodsFind($params)
    {
        //拿接口数据
        $apiParams = [
            'second_kill_id' => isset($params['second_kill_id']) ? $params['second_kill_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('seckill-goods-find', $apiParams);
    }

    /**
     * 修改秒杀商品
     * @param $params
     */
    public function seckillGoodsUpdate($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'second_kill_id' => isset($params['second_kill_id']) ? $params['second_kill_id'] : null,
            'product_id' => isset($params['product_id']) ? $params['product_id'] : null,
            'product_sku_id' => isset($params['product_sku_id']) ? $params['product_sku_id'] : null,
            'product_name' => isset($params['product_name']) ? $params['product_name'] : null,
            'product_price' => isset($params['product_price']) ? $params['product_price'] : null,
            'buy_price' => isset($params['buy_price']) ? $params['buy_price'] : null,
            'quota' => isset($params['quota']) ? $params['quota'] : null,
            'limit_buy' => isset($params['limit_buy']) ? $params['limit_buy'] : null,
            'sales_num' => isset($params['sales_num']) ? $params['sales_num'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('seckill-goods-update', $apiParams);
    }

    /**
     * 获取秒杀商品详情
     * @param $params
     */
    public function seckillGoodsGet($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'second_kill_id' => isset($params['second_kill_id']) ? $params['second_kill_id'] : null,
            'deleted' => isset($params['deleted']) ? $params['deleted'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('seckill-goods-get', $apiParams);
    }

    /**
     * 删除秒杀商品
     * @param $params
     */
    public function seckillGoodsDel($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('seckill-goods-del', $apiParams);
    }
    /**
     * 统计用户购买秒杀商品的数量
     * @param $params
     */
    public function countUserBuy($params)
    {
        $apiParams = [
            'activity_id' => isset($params['activity_id']) ? $params['activity_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'product_sku_id' => isset($params['product_sku_id']) ? $params['product_sku_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('seckill-user-seckill-buy', $apiParams);
    }
}
