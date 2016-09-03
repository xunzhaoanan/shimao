<?php
/**
 * Author: LiuPing
 * Date: 2015/9/2
 * Time: 15:19
 */

namespace common\forms\cardcoupon;

use common\forms\BaseForm;

class EditAjaxForm extends BaseForm
{
    public $id;
    public $title;
    public $card_type;
    public $quantity;
    public $logo_url;
    public $color;
    public $card_money;
    public $money_limit;
    public $get_limit;
    public $notice;
    public $description;
    public $service_phone;
    public $wx_card_id;
    public $wx_card_type;
    public $examine_type;
    public $code_type;
    public $can_share;
    public $can_give_friend;
    public $begin;
    public $end;
    public $date_info_type;
    public $range;
    public $assign; //判断选择门店的类型 -1无门店限制，1.指定门店
    public $deal_detail;
    public $custom_url_name;
    public $custom_url;
    public $custom_url_sub_title;
    public $promotion_url_name;
    public $promotion_url;
    public $promotion_url_sub_title;
    public $product_ids;

    public function rules()
    {
        return [
            [['id', 'title', 'card_type', 'quantity', 'logo_url', 'color', 'card_money', 'money_limit', 'get_limit', 'notice', 'description', 'service_phone'], 'required'],
            [['wx_card_type', 'examine_type', 'code_type', 'can_share', 'can_give_friend'], 'integer'],
            [['wx_card_id','range', 'deal_detail', 'custom_url_name', 'custom_url', 'custom_url_sub_title', 'promotion_url_name', 'promotion_url', 'promotion_url_sub_title', 'begin', 'end', 'date_info_type', 'assign', 'product_ids'], 'safe']
        ];
    }
}
