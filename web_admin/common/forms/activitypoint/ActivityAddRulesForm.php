<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\activitypoint;

use common\forms\BaseForm;

/**
 * @package common\forms
 */
class ActivityAddRulesForm extends BaseForm
{
    public $name;
    public $expire_type;
    public $start_time;
    public $end_time;
    public $sort;
    public $desc;

    public function rules()
    {
        return [
            [['name', 'expire_type'], 'required'],
            [['start_time', 'end_time'], 'safe'],
            [['desc', 'sort', 'expire_type', 'start_time', 'end_time'], 'integer']
        ];
    }
}
