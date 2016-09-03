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
class SigninSettingEditRulesForm extends BaseForm
{
    public $id;
    public $limit_count;
    public $pic_url;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['limit_count'], 'integer', 'min' => 0],
            [['pic_url'], 'string', 'max' => 150]
        ];
    }
}
