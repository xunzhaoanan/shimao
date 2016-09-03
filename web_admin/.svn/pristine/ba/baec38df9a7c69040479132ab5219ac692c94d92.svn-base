<?php
/**
 * Author: LiuPing
 * Date: 2015/06/30
 * Time: 9:58
 */

namespace common\forms\activitypoint;

use common\forms\BaseForm;

/**
 * @package common\forms
 */
class AddAjaxForm extends BaseForm
{
    public $pointsConsumption;
    public $activity;

    public function beforeValidate()
    {
        if (is_array($this->pointsConsumption) && count($this->pointsConsumption)) {
            $Form = new PointAddRulesForm();
            $params = ['PointAddRulesForm' => $this->pointsConsumption];
            $this->checkForm($params, $Form);
        } else {
            return false;
        }
        //检查活动设置
        if (is_array($this->activity) && count($this->activity)) {
            $Form = new ActivityAddRulesForm();
            $params = ['ActivityAddRulesForm' => $this->activity];
            $this->checkForm($params, $Form);
        } else {
            return false;
        }
        return true;
    }

    public function rules()
    {
        return [
            [['pointsConsumption', 'activity'], 'required']
        ];
    }
}
