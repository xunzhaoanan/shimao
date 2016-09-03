<?php
/**
 * Author: zhangjn
 * Date: 2016/5/4
 * Time: 10:46
 */

namespace common\forms\sms;

use common\forms\BaseForm;

/**
 * Class FindStatementDetailForm
 * @package common\forms
 */
class SmsSendListForm extends BaseForm
{
    public $createStart;
    public $createEnd;
    public $mobile;
    public $status;

    public function rules()
    {
        return [
            [['createStart', 'createEnd'], 'integer', 'min' => 0],
            [['mobile'], 'string', 'max' => 20],
            [['status'], 'safe']
        ];
    }
}