<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class UpdateShopMemberSettingForm extends BaseForm
{

    public $is_discount_with_point;
    public $is_member_discount;
    public $statistics_offset; //分层统计金额区间


    public function rules()
    {
        return [
            [['is_member_discount', 'is_discount_with_point'], 'integer'],
            [['statistics_offset'], 'integer', 'min' => 1000],
        ];
    }

}