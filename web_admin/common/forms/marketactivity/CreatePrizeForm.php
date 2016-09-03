<?php
/**
 * Author: LiuPing
 * Date: 2015/7/1
 * Time: 14:36:16
 */

namespace common\forms\marketactivity;

use common\forms\BaseForm;

class CreatePrizeForm extends BaseForm
{
    public $level;
    public $name;
    public $num;
    public $type;
    public $type_id;
    public $probability;
    public $prize_pic;

    public function rules()
    {
        return [
            [['level', 'name','probability'], 'required'],
            [['level', 'num','type','type_id'], 'integer', 'min' => 0],
            [['probability'], 'number'],
            [['name'], 'string', 'max' => 80],
            [['prize_pic'], 'string', 'max' => 150],
        ];
    }
}
