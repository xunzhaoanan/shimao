<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\role;


use common\forms\BaseForm;

/**
 * @package common\forms
 */
class AddAjaxForm extends BaseForm
{
    public $title;

    public function rules()
    {
        return [
            [['title'],'required']
        ];
    }
}
