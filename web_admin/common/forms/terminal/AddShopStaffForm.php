<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\forms\terminal;

use common\forms\BaseForm;

/**
 * Class AddShopInfoForm
 * @package common\forms
 */
class AddShopStaffForm extends BaseForm
{
    public $user_name;
    public $password;
    public $real_name;
    public $mobile;
    public $email;
    public $ewm_img;
    public $scene_id;
    public $path;

    public function rules()
    {
        return [
            [['user_name','password','real_name'], 'required'],
            [['user_name','real_name','mobile'], 'string','max'=>20],
            [['scene_id'],'integer', 'min'=>0],
            [['password'], 'string','max'=>32],
            [['email'], 'string','max'=>50],
            [['ewm_img'], 'string','max'=>180],
            [['path'], 'string','max'=>500],
        ];
    }
}


