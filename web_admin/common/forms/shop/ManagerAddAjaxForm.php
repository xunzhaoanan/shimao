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
class ManagerAddAjaxForm extends BaseForm
{
    public $name;
    public $qq;
    public $password;
    public $sex;
    public $role_id;
    public $phone;
    public $email;
    public $address;

    public function rules()
    {
        return [
            [['qq', 'role_id', 'password', 'name', 'sex', 'phone', 'email'], 'required'],
            [['address'], 'safe']
        ];
    }
}
