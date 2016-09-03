<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\secondkill;

use common\forms\BaseForm;

/**
 * @package common\forms
 */
class ActivityAddRulesForm extends BaseForm
{
    public $relate_product_type;
    public $name;
    public $expire_type;
    public $start_time;
    public $end_time;
    public $postage_setting_id;
    public $sort;
    public $wx_qrcode_id;
    public $desc;
    public $shop_id;
    public $shop_sub_id;

    public function rules()
    {
        return [
            [['relate_product_type', 'name', 'expire_type', 'start_time', 'end_time', 'shop_id', 'shop_sub_id'], 'required'],
            [['desc', 'relate_product_type', 'postage_setting_id', 'sort', 'expire_type', 'start_time', 'end_time', 'wx_qrcode_id', 'shop_id', 'shop_sub_id'], 'integer']
        ];
    }
}
