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
class TogetherbuyGoodsEditAjaxForm extends BaseForm
{
    public $id;
    public $buy_price;
    public $quota;
    public $together_num;
    public $limit_buy;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['buy_price', 'quota', 'limit_buy', 'together_num'], 'required']
        ];
    }
}
