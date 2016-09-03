<?php
/**
 * Author: ZhangP
 * Date: 2016/09/02
 * Time: 10:02:16
 */

namespace common\forms\test;

use common\forms\BaseForm;

/**
 * @package common\forms
 */
class TestForm extends BaseForm
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

