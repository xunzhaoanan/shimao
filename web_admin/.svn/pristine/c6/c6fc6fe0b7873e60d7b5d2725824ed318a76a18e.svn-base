<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\togetherbuy;

use common\forms\BaseForm;

/**
 * @package common\forms
 */
class TogetherBuyUpdateRulesForm extends BaseForm
{
    public $id;
    public $head_price;
    public $is_discount;
    public $is_agree;
    public $is_time_limit;
    public $time_limit;
    public $is_open;
    public $description;

    public $auto_icons; //认证标识
    public $is_auto_share; //动态分享
    public $is_more; //显示更多
    public $is_help; //开启注水

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['head_price', 'time_limit'], 'integer', 'min' => 0],
            [['is_agree', 'is_time_limit', 'is_agree', 'is_open', 'is_help', 'is_auto_share'], 'integer',  'min' => 1],
            [['description'], 'string'],
            [['auto_icons'], 'string',  'max' => '250'],
        ];
    }
}
