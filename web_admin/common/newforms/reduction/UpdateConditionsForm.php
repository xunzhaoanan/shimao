<?php
/**
 * Author: LiuPing
 * Date: 2016/05/16
 * Time: 13:30
 */

namespace common\newforms\reduction;

use common\newforms\BaseForm;

class UpdateConditionsForm extends BaseForm
{
    public $id;
    public $reduction_id;
    public $level;
    public $condition_type;
    public $condition_min;
    public $strategys;

    public function beforeValidate()
    {
        //检查优惠设置
        if (is_array($this->strategys) && count($this->strategys)) {
            foreach ($this->strategys as $val) {
                $Form = new UpdateRStrategysForm();
                $params = ['UpdateRStrategysForm' => $val];
                $this->checkForm($params, $Form);
            }
        } else {
            return false;
        }

        return true;
    }

    public function rules()
    {
        return [
            [['id', 'reduction_id'], 'required'],
            [['id', 'reduction_id', 'condition_type', 'level', 'condition_min'], 'integer', 'min' => 1],
            [['strategys'], 'safe']
        ];
    }
}