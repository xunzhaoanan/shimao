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
 * Class ShippingStatusUpdateForm
 * @package common\forms\shop
 */
class ShippingStatusUpdateForm extends BaseForm
{
    public $shipping_status;
    public $self_pickup_status;

    public function beforeValidate()
    {
        if ($this->shipping_status == Shop::SHIPPING_STATUS_OFF && $this->self_pickup_status == Shop::SELF_PICKUP_STATUS_OFF) return false;

        return true;
    }

    public function rules()
    {
        return [
            [['shipping_status'], 'in', 'range' => [Shop::SHIPPING_STATUS_ON, Shop::SHIPPING_STATUS_OFF]],
            [['self_pickup_status'], 'in', 'range' => [Shop::SELF_PICKUP_STATUS_ON, Shop::SELF_PICKUP_STATUS_OFF]]
        ];
    }
}