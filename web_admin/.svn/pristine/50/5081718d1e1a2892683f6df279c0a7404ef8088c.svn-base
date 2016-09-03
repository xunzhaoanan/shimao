<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class UpdateMemberCardActivateSettingForm extends BaseForm
{
    public $is_gift;
    public $content;
    public $gift_growth;
    public $is_gift_point;
    public $gift_point;
    public $is_gift_card;
    public $gift_card_type;
    public $gift_card_ids;
    public $is_gift_mall_packet;
    public $gift_mall_packet_type;
    public $gift_mall_packet_ids;
    public $is_gift_cash_packet;
    public $gift_cash_packet_type;
    public $gift_cash_packet_ids;

    public function rules()
    {
        return [
            [['is_gift','is_gift_point', 'gift_point', 'gift_growth', 'is_gift_card', 'gift_card_type', 'is_gift_mall_packet', 'gift_mall_packet_type', 'is_gift_cash_packet', 'gift_cash_packet_type'], 'integer'],
            [['content'], 'string'],
            [['gift_card_ids', 'gift_mall_packet_ids', 'gift_cash_packet_ids'], 'safe'],
        ];
    }

}