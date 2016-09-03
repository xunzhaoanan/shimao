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
class PointEditRulesForm extends BaseForm
{
    public $id;
    public $type;
    public $amount;
    public $points;
    public $count_type;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['type', 'amount', 'points', 'count_type'], 'safe']
        ];
    }
}
