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
class NewsAddAjaxRulesForm extends BaseForm
{
    public $title;
    public $description;
    public $content;
    public $cdn_path;
    public $media_id;
    public $url;
    public $show_cover_pic;

    public function rules()
    {
        return [
            [['title','description','content','cdn_path','media_id','show_cover_pic'], 'required'],
            ['url','safe']
        ];
    }
}
