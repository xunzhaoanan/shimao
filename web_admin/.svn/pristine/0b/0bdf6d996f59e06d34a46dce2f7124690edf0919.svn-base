<?php
/**
 * Author: LiuPing
 * Date: 2016/03/02
 * Time: 18:20
 */

namespace common\forms\togetherbuy;


use common\forms\activity\ImageTxtAddForm;
use common\forms\BaseForm;

/**
 * @package common\forms
 */
class FindJoinListAjaxForm extends BaseForm
{
    public $together_buy_queue_id;
    public $is_head;

    public function rules()
    {
        return [
            [['together_buy_queue_id'],'required'],
            [['is_head'],'safe']
        ];
    }
}
