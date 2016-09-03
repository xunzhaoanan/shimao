<?php
/**
 * Author: LiuPing
 * Date: 2015/07/1
 * Time: 10:23
 */

namespace common\forms\reserve;

use common\forms\activity\ImageTxtEditForm;
use common\forms\BaseForm;
use common\forms\product\ShareMessageEditForm;

/**
 * @package common\forms
 */
class GetUserDataAjaxForm extends BaseForm
{
    public $id; //预约用户信息id
    public $reserve_setting_id;

    public function rules()
    {
        return [
            [['id', 'reserve_setting_id'], 'required'],
            [['id', 'reserve_setting_id'], 'integer']
        ];
    }
}
