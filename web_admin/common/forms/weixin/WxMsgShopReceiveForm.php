<?php

namespace common\forms\weixin;

use common\forms\BaseForm;

/**
 * Class WxMsgShopReceiveForm
 * @package common\forms
 */
class WxMsgShopReceiveForm extends BaseForm
{
    public $id;
    public $send_to_operator;
    public $send_to_staff;
    public $send_to_belong_to_staff;
    public $operator_ids;
    public $staff_ids;
    public $belong_to_staff_ids;
    
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['send_to_operator','send_to_staff','send_to_belong_to_staff'], 'integer','min'=>1,'max'=>2],
            [['operator_ids','staff_ids','belong_to_staff_ids'], 'string'],
        ];
    }
}
