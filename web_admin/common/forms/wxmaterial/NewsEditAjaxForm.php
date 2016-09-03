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
class NewsEditAjaxForm extends BaseForm
{
    public $id;
    public $title;
    public $media_id;
    public $wxImagetxtReplyItems;

    public function beforeValidate()
    {
        if (is_array($this->wxImagetxtReplyItems) && count($this->wxImagetxtReplyItems)) {
            $Form = new NewsEditAjaxRulesForm();
            foreach($this->wxImagetxtReplyItems as $val) {
                $params = ['NewsEditAjaxRulesForm' => $val];
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
            [['id','title','media_id','wxImagetxtReplyItems'], 'required']
        ];
    }
}
