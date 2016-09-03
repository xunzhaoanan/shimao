<?php
/**
 * Author: LiuPing
 * Date: 2015/12/31
 * Time: 15:35
 */

namespace common\forms\cashredpack;

use common\forms\BaseForm;

class EditAjaxForm extends BaseForm
{
    public $id;
    public $send_name;
    public $act_name;
    public $wishing;
    public $remark;
    public $type;
    public $can_share;
    public $deleted;

    public function rules()
    {
        return [
            [['id', 'send_name', 'act_name', 'type', 'wishing', 'remark'], 'required'],
            [['can_share', 'deleted'], 'integer'],
            [['remark'], 'safe']
        ];
    }
}
