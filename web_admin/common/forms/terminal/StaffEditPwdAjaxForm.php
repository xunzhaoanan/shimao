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
class StaffEditPwdAjaxForm extends BaseForm
{
    public $oldPwd;
    public $newPwd;

    public function rules()
    {
        return [
            [['oldPwd','newPwd'], 'required']
        ];
    }

}
