<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\collect;


use common\forms\activity\ImageTxtAddForm;
use common\forms\activity\ShareMessageAddForm;
use common\forms\BaseForm;
use common\models\Collect;

/**
 * @package common\forms
 */
class AddProductAjaxForm extends BaseForm
{
    public $collect_id;
    public $product_id;
    public $product_sku_id;
    public $give;
    public $price;
    public $count;
    public $lastCount;
    public $number;
    public $minus;


    public function rules()
    {
        return [
            [['collect_id', 'product_id', 'product_sku_id', 'price', 'number', 'count'], 'required'],
            [['minus', 'lastCount', 'give'], 'safe']
        ];
    }
}
