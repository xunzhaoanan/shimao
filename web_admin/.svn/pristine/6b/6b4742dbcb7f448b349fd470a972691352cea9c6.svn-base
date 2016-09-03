<?php

namespace common\forms\weixin;

use common\forms\BaseForm;

/**
 * Class WxMsgTplUpdateForm
 * @package common\forms
 */
class WxMsgTplUpdateForm extends BaseForm
{
    public $id;
    public $deleted;
    public $mp_id;
    public $header;
    public $footer;
    public $remark;
    public $template_id;
    public $send_type;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id','template_id'], 'integer', 'min' => 1],
            [['deleted','send_type'], 'integer', 'min' => 1, 'max' => 2],
            [['mp_id'], 'string', 'max' => 50],
            [['header','footer','remark'], 'string', 'max' => 200],
        ];
    }
}
