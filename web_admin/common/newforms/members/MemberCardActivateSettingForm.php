<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class MemberCardActivateSettingForm extends BaseForm
{

    public $is_gift;
    public $gift_growth;
    public $gift_card_id;
    public $gift_mall_packet_id;
    public $gift_cash_packet_id;
    public $content;


    public function rules()
    {
        return [
            [['is_gift', 'gift_growth', 'gift_card_id', 'gift_mall_packet_id', 'gift_cash_packet_id'], 'integer'],
            [['content'], 'safe'],
        ];
    }

}