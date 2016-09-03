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
class PaymentSettingEditAjaxForm extends BaseForm
{
    public $id;
    public $account;
    public $sign_key;
    public $key;
    public $type;

    public function rules()
    {
        return [
            [['type'], 'required'],
            [['id' , 'key', 'account', 'sign_key'],'safe']
        ];
    }
}
