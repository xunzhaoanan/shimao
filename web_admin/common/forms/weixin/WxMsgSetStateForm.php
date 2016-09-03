<?php

namespace common\forms\weixin;

use common\forms\BaseForm;

/**
 * Class WxMsgSetStateForm
 * @package common\forms
 */
class WxMsgSetStateForm extends BaseForm
{
    public $id;
    public $type_id;
    public $state;

    public function rules()
    {
        return [
            [['id','type_id','state'], 'required'],
            [['state'], 'integer','min' => 1, 'max' => 2],
        ];
    }
}
