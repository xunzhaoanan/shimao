<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\redpack;

use common\forms\BaseForm;

/**
 * @package common\forms
 */
class AddActivityRulesForm extends BaseForm
{
    public $name;
    public $expire_type;
    public $start_time;
    public $end_time;
    public $sort;
    public $desc;
    public $deleted;
    public $share_type;

    public function rules()
    {
        return [
            [['name', 'start_time', 'end_time'], 'required'],
            [['deleted', 'share_type'], 'integer', 'min' => 1],
            [['sort', 'expire_type', 'start_time', 'end_time', 'name', 'desc'], 'safe']
        ];
    }
}
