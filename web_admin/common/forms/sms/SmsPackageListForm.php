<?php
/**
 * Author: zhangjn
 * Date: 2016/5/4
 * Time: 14:50
 */

namespace common\forms\sms;

use common\forms\BaseForm;

/**
 * Class FindStatementDetailForm
 * @package common\forms
 */
class SmsPackageListForm extends BaseForm
{
    public $status;
    public $type;

    public function rules()
    {
        return [
            [['status', 'type'], 'integer', 'min' => 0]
        ];
    }
}