<?php
/**
 * Author: LiuPing
 * Date: 2016/05/16
 * Time: 13:30
 */

namespace common\newforms\reduction;

use common\newforms\BaseForm;

class CreateProductListForm extends BaseForm
{
    public $reduction_id;
    public $products;

    public function beforeValidate()
    {
        //检查优惠设置
        if (is_array($this->products) && count($this->products)) {
            foreach ($this->products as $val) {
                $Form = new CreateRProductsForm();
                $params = ['CreateRProductsForm' => $val];
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
            [['products', 'reduction_id'], 'required'],
            [['reduction_id'], 'integer']
        ];
    }
}