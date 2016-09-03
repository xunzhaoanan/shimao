<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\forms\cardcoupon;

use common\forms\BaseForm;

/**
 * Class ListShopSubAjaxForm
 * @package common\forms
 */
class ListShopSubAjaxForm extends BaseForm
{
    public $_available_status;
    public $ids;
    public $name;

    public function rules()
    {
        return [
            [['_available_status','ids','name'], 'safe']
        ];
    }

}

