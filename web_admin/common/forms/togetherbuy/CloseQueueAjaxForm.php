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
class CloseQueueAjaxForm extends BaseForm
{
    public $id;
    public $close_reason;

    public function rules()
    {
        return [
            [['id', 'close_reason'],'required']
        ];
    }
}
