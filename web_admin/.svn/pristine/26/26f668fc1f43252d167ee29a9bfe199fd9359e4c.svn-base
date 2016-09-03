<?php

namespace common\forms\weixin;

use common\forms\BaseForm;

/**
 * Class WxMsgGetShopReceiveForm
 * @package common\forms
 */
class WxMsgGetShopReceiveForm extends BaseForm
{
    public $id;
    public $type_id;
    public function rules()
    {
        return [
            [['id','type_id'], 'required'],
            [['id','type_id'], 'integer'],
        ];
    }
}
