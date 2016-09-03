<?php
/**
 * Author: zhangjn
 * Date: 2016/4/6
 * Time: 10:47
 */

namespace common\forms\shop;

use common\forms\BaseForm;

class StatementReceiveSettingAjaxForm extends BaseForm
{
    public $payee;
    public $due_bank;
    public $opening_bank;
    public $account_no;
    public $tel;
    public $shop_sub_id;

    public function rules()
    {
        return [
            [['payee','due_bank','opening_bank','account_no'], 'required'],
            [['payee', 'account_no'], 'string', 'max' => 50],
            [['due_bank', 'opening_bank'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 20],
            [['shop_sub_id'], 'integer', 'min'=>1]
        ];
    }
}