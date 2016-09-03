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
class VoiceEditAjaxForm extends BaseForm
{
    public $id;
    public $title;
    public $music_url;
    public $hqmusic_url;
    public $description;
    public $thumb_media_id;
    public $cdn_path;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['title','music_url','hqmusic_url','description','thumb_media_id','cdn_path'], 'safe']
        ];
    }
}
