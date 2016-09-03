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
class ImageCreateAjaxForm extends BaseForm
{
    public $name;
    public $desc;
    public $tag_id;
    public $file_cdn_path;

    public function rules()
    {
        return [
            [['name','file_cdn_path'], 'required'],
            [['desc','tag_id'], 'safe']
        ];
    }
}
