<?php
/**
 * Author: LiuPing
 * Date: 2015/12/31
 * Time: 15:35
 */

namespace common\forms\cashredpack;

use common\forms\BaseForm;

class PolicyListAjaxForm extends BaseForm
{
    public $cash_redpack_id;
    public $type;
    public $deleted;
    public $name;

    public function rules()
    {
        return [
            [['cash_redpack_id', 'type', 'deleted'], 'integer'],
            [['name'], 'safe']
        ];
    }
}
