<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\forms\wxmaterial;

use common\forms\BaseForm;

/**
 * Class ShopForm
 * @package common\forms
 */
class NewsAddAjaxForm extends BaseForm
{
    public $title;
    public $item;

    public function beforeValidate()
    {
        if (is_array($this->item) && count($this->item)) {
            foreach($this->item as $val) {
                $params = ['NewsAddAjaxRulesForm' => $val];
                $Form = new NewsAddAjaxRulesForm();
                $this->checkForm($params, $Form);
            }
        }else{
            return false;
        }
        return true;
    }

    public function rules()
    {
        return [
            [['title','item'], 'required']
        ];
    }
}
