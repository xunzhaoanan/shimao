<?php

namespace common\forms\weixin;

use common\forms\BaseForm;

/**
 * Class WxGetReceiveListForm
 * @package common\forms
 */
class WxGetReceiveListForm extends BaseForm
{
    public $type_id;
    public $shop_sub_id;
    public $agent_id;

    public function rules()
    {
        return [
            [['type_id'], 'required'],
            [['type_id','shop_sub_id','agent_id'], 'integer'],
        ];
    }
}
