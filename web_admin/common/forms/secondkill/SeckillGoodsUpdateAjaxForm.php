<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\secondkill;

use common\forms\BaseForm;

/**
 * @package common\forms
 */
class SeckillGoodsUpdateAjaxForm extends BaseForm
{
    public $id;
    public $buy_price;
    public $quota;
    public $limit_buy;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['buy_price', 'quota', 'limit_buy'], 'safe']
        ];
    }
}
