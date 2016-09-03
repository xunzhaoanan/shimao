<?php
/**
 * Author: LiuPing
 * Date: 2015/8/5
 * Time: 18:36:16
 */

namespace weixin\forms\reserve;

namespace common\forms\reserve;

use common\forms\BaseForm;

/**
 * Class EditUserDataAjaxForm
 * @package common\forms
 */
class EditReserveUserDataAjaxForm extends BaseForm
{
    public $id;
    public $reserve_setting_id;
    public $user_data;
    public $user_id;

    public function rules()
    {
        return [
            [['id', 'reserve_setting_id', 'user_data', 'user_id'], 'required'],
            [['reserve_setting_id'], 'integer']
        ];
    }
}
