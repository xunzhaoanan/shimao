<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\forms\document;

use common\forms\BaseForm;

/**
 * @package common\forms
 */
class EditAjaxForm extends BaseForm
{
    public $id;
    public $name;
    public $file_type;
    public $category_id;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['category_id','file_type','name'], 'safe']
        ];
    }
}
