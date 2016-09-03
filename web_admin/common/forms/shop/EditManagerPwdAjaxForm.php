<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\forms\shop;

use common\forms\BaseForm;

/**
 * Class ShopForm
 * @package common\forms
 */
class EditManagerPwdAjaxForm extends BaseForm
{
    public $id;
    public $password;

    public function rules()
    {
        return [
            [['id', 'password'], 'required'],
        ];
    }
}
