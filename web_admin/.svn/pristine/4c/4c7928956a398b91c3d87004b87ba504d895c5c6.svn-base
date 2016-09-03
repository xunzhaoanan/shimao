<?php

namespace common\forms\weixin;

use common\forms\BaseForm;

/**
 * Class WxMsgTplDetailForm
 * @package common\forms
 */
class WxMsgTplDetailForm extends BaseForm
{
    public $id;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer', 'min' => 1]
        ];
    }
}
