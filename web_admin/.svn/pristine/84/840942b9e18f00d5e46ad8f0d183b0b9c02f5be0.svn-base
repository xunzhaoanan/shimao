<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\forms\document;

use common\forms\BaseForm;

/**
 * @package common\forms
 */
class CreateAjaxForm extends BaseForm
{
    public $list;

    public function beforeValidate()
    {
        if (is_array($this->list) && count($this->list)) {
            $Form = new CreateAjaxRuleForm();
            foreach($this->list as $val) {
                $params = ['CreateAjaxRuleForm' => $val];
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
            [['list'], 'required']
        ];
    }
}
