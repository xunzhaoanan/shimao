<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\forms\login;

use common\forms\BaseForm;

/**
 * @package common\forms
 */
class LoginForm extends BaseForm
{
    public $username;
    public $password;
    public $captcha;

    public function rules()
    {
        return [
            [['username', 'password','captcha'], 'required'],
        ];
    }
}

