<?php
/**
 * Author: LiuPing
 * Date: 2015/12/31
 * Time: 15:35
 */

namespace common\forms\cashredpack;

use common\forms\BaseForm;

class AddAjaxForm extends BaseForm
{
    public $send_name;
    public $act_name;
    public $type;
    public $min_value;
    public $max_value;
    public $wishing;
    public $quantity;
    public $remark;
    public $platform;
    public $can_share;
    public $deleted;

    public function rules()
    {
        return [
            [['send_name', 'act_name', 'type', 'quantity', 'min_value', 'max_value', 'wishing', 'remark'], 'required'],
            [['can_share', 'deleted'], 'integer'],
            [['remark'], 'safe']
        ];
    }
}
