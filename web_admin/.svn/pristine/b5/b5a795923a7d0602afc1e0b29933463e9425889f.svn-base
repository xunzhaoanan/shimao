<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\secondkill;

use common\forms\BaseForm;

/**
 * @package common\forms
 */
class SeckillGoodsAddAjaxForm extends BaseForm
{
    public $second_kill_id;
    public $product_id;
    public $product_sku_id;
    public $buy_price;
    public $quota;
    public $limit_buy;

    public function rules()
    {
        return [
            [['second_kill_id', 'product_id', 'product_sku_id', 'buy_price', 'quota', 'limit_buy'], 'required']
        ];
    }
}
