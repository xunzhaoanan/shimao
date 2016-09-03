<?php
/**
 * Author: LiuPing
 * Date: 2015/9/2
 * Time: 15:19
 */

namespace common\forms\cardcoupon;

use common\forms\BaseForm;

class AddHandSendAjaxForm extends BaseForm
{
    public $card_type_id;
    public $to_user_ids; //数组
    public $user_group; //分组id
    public $user_type; //派发时指定的用户类型 1.用户 2.分组

    public function rules()
    {
        return [
            [['card_type_id', 'user_type'], 'required'],
            [['user_group', 'to_user_ids'], 'safe']
        ];
    }
}
