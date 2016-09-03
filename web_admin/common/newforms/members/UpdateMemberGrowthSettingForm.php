<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class UpdateMemberGrowthSettingForm extends BaseForm
{

    public $shop_id;
    public $is_cost_growth;
    public $cost_amount;
    public $cost_growth;
    public $is_comment_growth;
    public $comment_growth;
    public $is_login_growth;
    public $login_growth;
    public $is_point_growth;
    public $get_point;
    public $get_point_growth;
    public $point_max_growth;
    public $is_month_cost_total_growth;
    public $month_cost_total_count;
    public $month_cost_total_growth;

    public function rules()
    {
        return [
            [['is_cost_growth', 'cost_amount', 'cost_growth', 'is_comment_growth', 'comment_growth', 'is_login_growth', 'login_growth', 'is_point_growth', 'get_point', 'get_point_growth', 'point_max_growth', 'is_month_cost_total_growth', 'month_cost_total_count', 'month_cost_total_growth'], 'integer'],
        ];
    }

}