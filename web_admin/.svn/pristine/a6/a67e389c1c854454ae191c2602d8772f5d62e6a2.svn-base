<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\secondkill;


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
