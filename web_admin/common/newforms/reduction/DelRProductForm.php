<?php
/**
 * Author: LiuPing
 * Date: 2016/05/16
 * Time: 13:30
 */

namespace common\newforms\reduction;

use common\newforms\BaseForm;

class DelRProductForm extends BaseForm
{
    public $product_id;
    public $product_sku_id;
    public $reduction_id;

    public function rules()
    {
        return [
            [['product_id', 'product_sku_id', 'reduction_id'], 'required'],
            [['product_id', 'product_sku_id','reduction_id'], 'integer', 'min' => 1]
        ];
    }
}