<?php
/**
 * Author: LiuPing
 * Date: 2015/9/2
 * Time: 15:19
 */

namespace common\forms\cardcoupon;

use common\forms\BaseForm;
use common\models\CardCoupon;

class AddAjaxForm extends BaseForm
{
    public $title;
    public $brand_name;
    public $card_type;
    public $quantity;
    public $logo_url;
    public $color;
    public $wx_card_type;
    public $card_money;
    public $card_discount;
    public $money_limit;
    public $exchange_content_text;
    public $get_limit;
    public $product_ids;
    public $notice;
    public $description;
    public $service_phone;
    public $code_type;
    public $can_share;
    public $can_give_friend;
    public $begin;
    public $end;
    public $date_info_type;
    public $range;
    public $deal_detail;
    public $custom_url_name;
    public $custom_url;
    public $custom_url_sub_title;
    public $promotion_url_name;
    public $promotion_url;
    public $promotion_url_sub_title;
    public $assign; //判断选择门店的类型 -1无门店限制，1.指定门店

    public function rules()
    {
        return [
            [['title', 'card_type', 'quantity', 'logo_url', 'color', 'card_money','money_limit', 'get_limit', 'notice', 'description', 'service_phone', 'assign', 'brand_name','wx_card_type'], 'required'],
            [['wx_card_type'], 'in', 'range' => array(CardCoupon::WX_CARD_TYPE_CACH, CardCoupon::WX_CARD_TYPE_DISCOUNT, CardCoupon::WX_CARD_TYPE_GIFT)],
            [['code_type', 'can_share', 'can_give_friend', 'date_info_type', 'begin', 'end'], 'integer'],
            [['range', 'deal_detail', 'custom_url_name', 'custom_url', 'custom_url_sub_title', 'promotion_url_name', 'promotion_url', 'promotion_url_sub_title','card_discount','exchange_content_text','product_ids'], 'safe']
        ];
    }
}
