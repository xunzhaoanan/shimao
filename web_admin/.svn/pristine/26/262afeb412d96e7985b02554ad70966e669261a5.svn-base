<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\redpack;

use common\forms\BaseForm;

/**
 * @package common\forms
 */
class EditRedpacketRulesForm extends BaseForm
{
    public $id;
    public $is_attention;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['is_attention'], 'safe']
        ];
    }
}
