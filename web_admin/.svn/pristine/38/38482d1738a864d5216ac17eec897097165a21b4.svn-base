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
class VideoAddAjaxForm extends BaseForm
{
    public $title;
    public $description;
    public $media_id;
    public $cdn_path;

    public function rules()
    {
        return [
            [['title','description','media_id','cdn_path'], 'required']
        ];
    }
}
