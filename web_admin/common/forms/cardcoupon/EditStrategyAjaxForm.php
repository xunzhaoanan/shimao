<?php
/**
 * Author: LiuPing
 * Date: 2015/9/2
 * Time: 15:19
 */

namespace common\forms\cardcoupon;

use common\forms\BaseForm;

class EditStrategyAjaxForm extends BaseForm
{
    public $id;
    public $card_type_id;
    public $name;
    public $type;
    public $order_limit;
    public $amount;
    public $product_ids;

    public function rules()
    {
        return [
            [['id', 'card_type_id', 'name', 'type', 'order_limit'], 'required'],
            [['amount'], 'integer'],
            [['product_ids'], 'safe']
        ];
    }
}
