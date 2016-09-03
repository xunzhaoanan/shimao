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
class MusicAddAjaxForm extends BaseForm
{
    public $title;
    public $music_url;
    public $cdn_path;

    public function rules()
    {
        return [
            [['title','media_id','cdn_path'], 'required']
        ];
    }
}
