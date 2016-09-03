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
class TogetherBuyAddRulesForm extends BaseForm
{
    public $head_price;
    public $is_discount;
    public $is_agree;
    public $is_time_limit;
    public $time_limit;

    public function rules()
    {
        return [
            [['head_price', 'time_limit'], 'integer', 'min' => 0],
            [['is_agree', 'is_time_limit', 'is_agree'], 'integer',  'min' => 1]
        ];
    }
}
