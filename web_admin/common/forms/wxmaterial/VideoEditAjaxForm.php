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
class VideoEditAjaxForm extends BaseForm
{
    public $id;
    public $title;
    public $description;
    public $media_id;
    public $cdn_path;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['title','description','media_id','cdn_path'], 'safe']
        ];
    }
}
