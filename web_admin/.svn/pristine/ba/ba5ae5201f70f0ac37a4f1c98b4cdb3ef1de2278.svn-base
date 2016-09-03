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
class StaffEditAjaxForm extends BaseForm
{
    public $id;
    public $user_name;
    public $real_name;
    public $role_id;
    public $mobile;
    public $email;
    public $ewm_img;
    public $scene_id;
    public $path;

    public function rules()
    {
        return [
            [['id','role_id','user_name','real_name'], 'required'],
            [['mobile','ewm_img','scene_id','path','email'], 'safe']
        ];
    }

}
