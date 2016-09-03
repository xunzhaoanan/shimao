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
class QqLoginForm extends BaseForm
{
    public $qq;
    public $token;


    public function rules()
    {
        return [
            [['qq', 'token'], 'required'],
        ];
    }
}

