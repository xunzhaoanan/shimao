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
class ManagerEditAjaxForm extends BaseForm
{
    public $id;
    public $name;
    public $qq;
    //public $password; 修改密码时，密码是md5加密，不修改后提交时有问题
    public $sex;
    public $role_id;
    public $phone;
    public $email;
    public $address;

    public function rules()
    {
        return [
            [['id', 'role_id', 'qq', 'name', 'sex', 'phone', 'email'], 'required'],
            [['address'], 'safe']
        ];
    }
}
