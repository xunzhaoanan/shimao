<?php
/**
 * Author: LiuPing
 * Date: 2015/12/31
 * Time: 15:35
 */

namespace common\forms\cashredpack;

use common\forms\BaseForm;

class PolicyAddAjaxForm extends BaseForm
{
    public $cash_redpack_id;
    public $type;
    public $name;
    public $amount;
    public $product_ids;

    public function rules()
    {
        return [
            [['cash_redpack_id', 'type', 'name'], 'required'],
            [['cash_redpack_id', 'type', 'amount'], 'integer'],
            [['name', 'product_ids'], 'safe']
        ];
    }
}
