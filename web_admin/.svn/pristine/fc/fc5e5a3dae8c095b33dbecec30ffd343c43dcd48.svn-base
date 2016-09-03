<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\forms\terminal;

use common\forms\BaseForm;

/**
 * Class WxAccountAjaxForm
 * @package common\forms
 */
class StaffAddAjaxForm extends BaseForm
{
    public $user_name;
    public $password;
    public $real_name;
    public $shop_sub_id;
    public $role_id;
    public $mobile;
    public $email;
    public $ewm_img;
    public $scene_id;
    public $path;

    public function rules()
    {
        return [
            [['role_id','user_name','password','real_name','shop_sub_id'], 'required'],
            [['mobile','ewm_img','scene_id','path','email'], 'safe']
        ];
    }

}
