<?php

namespace common\forms\weixin;

use common\forms\BaseForm;

/**
 * Class WxMsgUpdateForm
 * @package common\forms
 */
class WxMsgUpdateForm extends BaseForm
{
    public $id;
    public $type_id;
    public $send_type;    
    public $template_id;
    public $header;
    public $footer;
    public $mp_id;
    public $send_by_sms;
    
    public function rules()
    {
        return [
            [['id','type_id','send_type'], 'required'],
            [['id','type_id','send_type','template_id','send_by_sms'], 'integer'],
            [['send_type'], 'integer','min' => 0, 'max' => 2],
            [['header','footer','mp_id'], 'string'],
        ];
    }
}
