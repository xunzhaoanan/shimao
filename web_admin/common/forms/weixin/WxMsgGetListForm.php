<?php

namespace common\forms\weixin;

use common\forms\BaseForm;

/**
 * Class WxMsgTplUpdateStatusForm
 * @package common\forms
 */
class WxMsgGetListForm extends BaseForm
{
    public $to_user;
    public $module;

    public function rules()
    {
        return [
            [['to_user'], 'required'],
            [['to_user','module'], 'integer','min' => 1],
        ];
    }
}
