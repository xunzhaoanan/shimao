<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\forms\wxmaterial;

use common\forms\BaseForm;

/**
 * Class ShopForm
 * @package common\forms
 */
class TextAddAjaxForm extends BaseForm
{
    public $title;
    public $reply_content;

    public function rules()
    {
        return [
            [['title','reply_content'], 'required']
        ];
    }
}
