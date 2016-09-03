<?php
/**
 * Author: LiuPing
 * Date: 2015/7/1
 * Time: 14:36:16
 */

namespace common\forms\marketactivity;

use common\forms\BaseForm;

class CreateExtendForm extends BaseForm
{
    public $level;
    public $key;
    public $value;

    public function rules()
    {
        return [
            [['level', 'key'], 'required'],
            [['level'], 'integer', 'min' => 0],
            [['key'], 'string', 'max' => 50],
            [['value'], 'string'],
        ];
    }
}
