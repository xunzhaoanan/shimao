<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\forms\shop;

use common\forms\BaseForm;

/**
 * Class ShopForm
 * @package common\forms
 */
class ScanPayAjaxForm extends BaseForm
{
    public $scan_limit_amount;


    public function rules()
    {
        return [
            [['scan_limit_amount'], 'required'],
            [['scan_limit_amount'], 'integer','min'=>1]
        ];
    }
}
