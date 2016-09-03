<?php
/**
 * Author: LiuPing
 * Date: 2015/12/31
 * Time: 15:35
 */

namespace common\forms\cashredpack;

use common\forms\BaseForm;

class ListAjaxForm extends BaseForm
{
    public $type;
    public $can_share;
    public $deleted;
    public $valid;
    public $act_name;

    public function rules()
    {
        return [
            [['type', 'deleted', 'can_share'], 'integer'],
            [['act_name', 'valid'], 'safe']
        ];
    }
}
