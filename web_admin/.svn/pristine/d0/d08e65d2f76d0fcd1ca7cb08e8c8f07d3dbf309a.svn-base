<?php

namespace common\forms\weixin;

use common\forms\BaseForm;

/**
 * Class WxMsgTplDetailForm
 * @package common\forms
 */
class WxMsgTplGetDetailForm extends BaseForm
{
    public $id;
    public $type_id;
    public function rules()
    {
        return [
            [['id','type_id'], 'required'],
            [['id'], 'integer', 'min' => 0],
            [['type_id'], 'integer', 'min' => 1],
        ];
    }
}
