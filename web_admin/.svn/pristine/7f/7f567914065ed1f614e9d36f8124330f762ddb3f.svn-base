<?php
/**
 * Author: LiuPing
 * Date: 2015/12/31
 * Time: 15:35
 */

namespace common\forms\cashredpack;

use common\forms\BaseForm;

class SendAjaxForm extends BaseForm
{
    public $cash_redpack_id;
    public $uids;  //id数组
    public $group_ids;  //多群组id数组

    public function rules()
    {
        return [
            [['cash_redpack_id'], 'integer'],
            [['group_ids', 'uids'], 'safe']
        ];
    }
}
