<?php
/**
 * Author: zhangjn
 * Date: 2016/5/4
 * Time: 15:24
 */

namespace common\forms\sms;

use common\forms\BaseForm;

/**
 * Class FindStatementDetailForm
 * @package common\forms
 */
class SmsFlowListForm extends BaseForm
{
    public $createStart;
    public $createEnd;
    public $order_no;
    public $recharge_type;
    public $status;

    public function rules()
    {
        return [
            [['createStart', 'createEnd', 'recharge_type', 'status'], 'integer', 'min' => 0],
            [['order_no'], 'string', 'max' => 60]
        ];
    }
}