<?php
/**
 * Author: zhangjn
 * Date: 2016/4/7
 * Time: 15:14
 */

namespace common\forms\shop;

use common\forms\BaseForm;
use common\models\Shop;
use common\models\Order;

/**
 * Class ReturnGoodsSettingUpdate
 * @package common\forms\shop
 */
class ReturnGoodsSettingForm extends BaseForm
{
    public $return_goods;
    public $return_goods_order_type;

    public function beforeValidate()
    {
        if (!$this->return_goods && $this->return_goods_order_type) return false;
        //错误的订单类型
        if ($this->return_goods_order_type) {
            $data = explode(',', $this->return_goods_order_type);
            $arr = [Order::ORDER_TYPE_NORMAL, Order::ORDER_TYPE_SECONDKILL];
            foreach($data as $v){
                if(!in_array($v, $arr)) return false;
            }
        }
        return true;
    }

    public function rules()
    {
        return [
            [['return_goods'], 'in', 'range' => [Shop::RETURN_GOODS_ON, Shop::RETURN_GOODS_OFF]],
            [['return_goods_order_type'], 'string', 'max' => 50]
        ];
    }
}