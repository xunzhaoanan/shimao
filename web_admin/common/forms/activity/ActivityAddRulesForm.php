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
 * 空白活动的创建表单验证
 */
class ActivityAddRulesForm extends BaseForm
{
    public $shop_id;
    public $shop_sub_id;

    public function rules()
    {
        return [
            [['shop_id', 'shop_sub_id'], 'required']
        ];
    }
}
