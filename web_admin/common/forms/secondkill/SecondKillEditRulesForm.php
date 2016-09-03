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
class SecondKillEditRulesForm extends BaseForm
{
    public $id;

    public function rules()
    {
        return [
            [['id'], 'required']
        ];
    }
}
