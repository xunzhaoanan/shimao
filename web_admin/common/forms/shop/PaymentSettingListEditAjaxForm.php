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
class PaymentSettingListEditAjaxForm extends BaseForm
{
    public $tenpay;
    public $wxpay;
    public $delivery;
    public $agentpay;
    public $newwxpay;
    public $qqpay;

    public function rules()
    {
        return [
            [['tenpay','wxpay','delivery','agentpay','newwxpay','qqpay'], 'required']
        ];
    }
}
