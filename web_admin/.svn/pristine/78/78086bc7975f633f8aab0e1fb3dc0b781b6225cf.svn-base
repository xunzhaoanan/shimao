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
class NewsEditAjaxRulesForm extends BaseForm
{
    public $id;
    public $title;
    public $description;
    public $content;
    public $cdn_path;
    public $media_id;
    public $url;

    public function rules()
    {
        return [
            [['id','title','description','content','cdn_path','media_id','url'], 'safe']
        ];
    }
}
