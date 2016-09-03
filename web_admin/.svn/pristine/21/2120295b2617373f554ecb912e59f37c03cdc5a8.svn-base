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
class NewsWshEditAjaxForm extends BaseForm
{
    public $title;
    public $wxImagetxtReplyItems;
    public $id;

    public function beforeValidate()
    {
        if (is_array($this->wxImagetxtReplyItems) && count($this->wxImagetxtReplyItems)) {
            foreach($this->wxImagetxtReplyItems as $key=>$val) {

                $params = ['NewsWshEditAjaxRulesForm' => $val];
                $Form = new NewsWshEditAjaxRulesForm();
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
            [['id','title','wxImagetxtReplyItems'], 'required']
        ];
    }
}
