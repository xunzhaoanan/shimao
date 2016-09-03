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
class ImageAddAjaxForm extends BaseForm
{
    public $title;
    public $media_id;
    public $cdn_path;
    public $wx_url;
    public $category_id;

    public function rules()
    {
        return [
            [['title','media_id','cdn_path','wx_url'], 'required'],
            [['category_id'], 'safe']
        ];
    }
}
