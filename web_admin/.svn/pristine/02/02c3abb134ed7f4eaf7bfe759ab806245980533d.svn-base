<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\forms\cardcoupon;

use common\forms\BaseForm;

/**
 * Class ListShopSubAjaxForm
 * @package common\forms
 */
class ListRecordAjaxForm extends BaseForm
{
    public $_status;
    public $status;
    public $card_type_id; //卡券id
    public $from_user_id;
    public $to_user_id;
    public $type; //领券类型 默认1微商户系统 2微信
    public $receive_type; //获取卡券途径1直接领取，2手动派送，3抽奖活动，4购物赠送，5游戏奖励
    public $code;
    public $codeFlag; //编号是否模糊查询
    public $nickname;
    public $member_detail;
    public $value;

    public function rules()
    {
        return [
            [['_status', 'card_type_id', 'from_user_id', 'to_user_id', 'type', 'receive_type', 'code',  'codeFlag', 'nickname', 'status', 'member_detail','value'], 'safe']
        ];
    }

}

