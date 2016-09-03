<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\togetherbuy;

use common\forms\BaseForm;

/**
 * @package common\forms
 */
class TogetherbuyGoodsAddAjaxForm extends BaseForm
{
    public $together_buy_id;
    public $product_id;
    public $product_sku_id;
    public $buy_price;
    public $quota;
    public $together_num;
    public $limit_buy;

    public function rules()
    {
        return [
            [['together_buy_id', 'product_id', 'product_sku_id', 'buy_price', 'quota', 'limit_buy', 'together_num'], 'required']
        ];
    }
}
