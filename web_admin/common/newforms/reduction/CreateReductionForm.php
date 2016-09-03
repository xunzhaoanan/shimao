<?php
/**
 * Author: LiuPing
 * Date: 2016/05/16
 * Time: 13:30
 */

namespace common\newforms\reduction;

use common\newforms\BaseForm;
use common\newservices\Reduction;

class CreateReductionForm extends BaseForm
{
    public $name;
    public $is_relate_all;
    public $start_time;
    public $end_time;

    public $products;
    public $conditions;

    public function beforeValidate()
    {
        //检查关联商品
        if (($this->is_relate_all == Reduction::IS_RELATE_ALL_NO) && is_array($this->products) && count($this->products)) {
            foreach ($this->products as $val) {
                $Form = new CreateRProductsForm();
                $params = ['CreateRProductsForm' => $val];
                $this->checkForm($params, $Form);
            }
        } elseif ($this->is_relate_all == Reduction::IS_RELATE_ALL_NO) {
            return false;
        }

        //检查层级设置
        if (is_array($this->conditions) && count($this->conditions)) {
            foreach($this->conditions as $val){
                $Form = new CreateConditionsForm();
                $params = ['CreateConditionsForm' => $val];
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
            [['name', 'is_relate_all','start_time','end_time'], 'required'],
            [['start_time','end_time', 'is_relate_all'], 'integer', 'min' => 1],
            [['name'], 'string', 'max' => 255],
            [['products', 'conditions'], 'safe']
        ];
    }
}