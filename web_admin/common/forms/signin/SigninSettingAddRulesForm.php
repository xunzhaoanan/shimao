<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\signin;

use common\forms\BaseForm;

/**
 * @package common\forms
 */
class SigninSettingAddRulesAjaxForm extends BaseForm
{
    public $pic_url;
    public $limit_count;

    public function rules()
    {
        return [
            [['limit_count'], 'integer', 'min' => 0],
            [['pic_url'], 'string', 'max' => 150]
        ];
    }
}
