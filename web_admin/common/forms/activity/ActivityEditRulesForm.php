<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\activity;

use common\forms\BaseForm;

/**
 * @package common\forms
 */
class ActivityEditRulesForm extends BaseForm
{
    public $id;
    public $relate_product_type;
    public $name;
    public $expire_type;
    public $start_time;
    public $end_time;
    public $postage_setting_id;
    public $sort;
    public $wx_qrcode_id;
    public $desc;
    public $share_type;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'postage_setting_id', 'relate_product_type', 'sort', 'expire_type', 'start_time', 'end_time', 'wx_qrcode_id','name', 'desc', 'share_type'], 'safe']
        ];
    }
}
