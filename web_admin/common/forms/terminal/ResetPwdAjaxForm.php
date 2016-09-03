<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\forms\terminal;

use common\forms\BaseForm;

/**
 * Class AgentResetPwdAjaxForm
 * @package common\forms
 */
class ResetPwdAjaxForm extends BaseForm
{
    public $id;
    public $new_pwd;

    public function rules()
    {
        return [
            [['id', 'new_pwd'], 'required'],
        ];
    }

}

