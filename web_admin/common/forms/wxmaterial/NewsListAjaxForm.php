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
class NewsListAjaxForm extends BaseForm
{
    public $title;
    public $is_wsh;

    public function rules()
    {
        return [
            [['title','is_wsh'], 'safe']
        ];
    }
}
