<?php

namespace common\forms\weixin;

use common\forms\BaseForm;

/**
 * Class WxMsgTplUpdateStatusForm
 * @package common\forms
 */
class WxMsgTplUpdateStatusForm extends BaseForm
{
    public $id;
    public $deleted;
    public $mp_id;
    public $header;
    public $footer;
    public $remark;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer', 'min' => 1],
            [['deleted'], 'integer', 'min' => 1, 'max' => 2]
        ];
    }
}
