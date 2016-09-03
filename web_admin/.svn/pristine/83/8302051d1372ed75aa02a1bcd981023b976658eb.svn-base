<?php
/**
 * Author: LiuPing
 * Date: 2016/03/02
 * Time: 18:20
 */

namespace common\forms\togetherbuy;


use common\forms\activity\ImageTxtAddForm;
use common\forms\BaseForm;

/**
 * @package common\forms
 */
class AddAjaxForm extends BaseForm
{
    public $news;

    public function beforeValidate()
    {
        if (is_array($this->news) && count($this->news)) {
            $Form = new ImageTxtAddForm();
            $params = ['ImageTxtAddForm' => $this->news];
            $this->checkForm($params, $Form);
        } else {
            return false;
        }

        return true;
    }

    public function rules()
    {
        return [
            [['news'],'required']
        ];
    }
}
