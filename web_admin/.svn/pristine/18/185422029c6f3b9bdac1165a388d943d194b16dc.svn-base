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
class ImageAjaxForm extends BaseForm
{
    public $tag_id;
    public $name;
    public $is_search = false;
    public $category_id;

    public function rules()
    {
        return [
            [['tag_id', 'name', 'is_search', 'category_id'], 'safe']
        ];
    }
}
