<?php
/**
 * Author: LiuPing
 * Date: 2015/12/31
 * Time: 15:35
 */

namespace common\forms\cashredpack;

use common\forms\BaseForm;

class PolicyEditAjaxForm extends BaseForm
{
    public $id;
    public $cash_redpack_id;
    public $type;
    public $name;
    public $amount;
    public $product_ids;

    public function rules()
    {
        return [
            [['id', 'cash_redpack_id', 'type', 'name'], 'required'],
            [['id', 'cash_redpack_id', 'type', 'amount'], 'integer'],
            [['name', 'product_ids'], 'safe']
        ];
    }
}
