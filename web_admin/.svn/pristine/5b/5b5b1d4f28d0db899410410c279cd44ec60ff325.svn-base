<?php

namespace common\forms\weixin;

use common\forms\BaseForm;

/**
 * Class WxMsgTplCreateForm
 * @package common\forms
 */
class WxMsgCreateDefaultStaffForm extends BaseForm
{
    public $staff_id;

    public function rules()
    {
        return [
            [['staff_id'], 'required'],
            [['staff_id'], 'integer', 'min' => 1]
        ];
    }
}
