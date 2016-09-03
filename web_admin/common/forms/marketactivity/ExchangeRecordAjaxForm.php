<?php
/**
 * Author: LiuPing
 * Date: 2015/7/1
 * Time: 14:36:16
 */

namespace common\forms\marketactivity;

use common\forms\activity\ImageTxtAddForm;
use common\forms\activity\ShareMessageAddForm;
use common\forms\BaseForm;

class ExchangeRecordAjaxForm extends BaseForm
{
    public $marketing_activity_id;
    public $id;

    public function rules()
    {
        return [
            [['marketing_activity_id', 'id'], 'required']
        ];
    }
}
