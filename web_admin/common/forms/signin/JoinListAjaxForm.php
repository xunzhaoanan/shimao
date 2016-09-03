<?php
/**
 * Author: LiuPing
 * Date: 2016/03/22
 * Time: 15:19
 */

namespace common\forms\signin;

use common\forms\BaseForm;
use common\forms\redpack\AddActivityRulesForm;

/**
 * @package common\forms
 */
class JoinListAjaxForm extends BaseForm
{
    public $id;
    public $nickName;

    public function rules()
    {
        return [
            [['nickName'], 'string'],
            [['id'], 'integer', 'min' => 0]
        ];
    }
}
