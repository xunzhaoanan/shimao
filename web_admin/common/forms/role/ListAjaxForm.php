<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\role;


use common\forms\BaseForm;

/**
 * @package common\forms
 */
class ListAjaxForm extends BaseForm
{
    public $shop_sub_id;

    public function rules()
    {
        return [
            [['shop_sub_id'],'safe']
        ];
    }
}
