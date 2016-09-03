<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\forms\shop;

use common\forms\BaseForm;

/**
 * Class AddUsedAddressForm
 * @package common\forms
 */
class AddUsedAddressForm extends BaseForm
{
    public $return_address;
    public $return_consignee;
    public $return_phone;

    public function rules()
    {
        return [
            [['return_consignee', 'return_phone', 'return_address'], 'required'],
            [['return_consignee'], 'string', 'max' => 50],
            [['return_phone'], 'string', 'max' => 16],
            [['return_address'], 'string', 'max' => 300],
        ];
    }
}
