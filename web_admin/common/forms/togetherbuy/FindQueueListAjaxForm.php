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
class FindQueueListAjaxForm extends BaseForm
{
    public $together_buy_id;
    public $headNickname;
    public $_status;

    public function rules()
    {
        return [
            [['together_buy_id'],'required'],
            [['headNickname', '_status'],'safe']
        ];
    }
}
