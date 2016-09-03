<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\activity;

use common\forms\BaseForm;

/**
 * @package common\forms
 */
class PostageSettingAddForm extends BaseForm
{

    public $type;
    public $num;
    public $amount;

    public function rules()
    {
        return [
            [['type'], 'required'],
            [['num', 'amount'], 'safe'],
        ];
    }
}
