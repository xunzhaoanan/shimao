<?php
/**
 * Author: LiuPing
 * Date: 2016/05/16
 * Time: 13:30
 */

namespace common\newforms\reduction;

use common\newforms\BaseForm;

class CreateConditionsForm extends BaseForm
{
    public $condition_type;
    public $level;
    public $condition_min;

    public $strategys;

    public function beforeValidate()
    {
        //检查优惠设置
        if (is_array($this->strategys) && count($this->strategys)) {
            foreach($this->strategys as $val){
                $Form = new CreateRStrategysForm();
                $params = ['CreateRStrategysForm' => $val];
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
            [['condition_type', 'level', 'condition_min', 'strategys'], 'safe']
        ];
    }
}