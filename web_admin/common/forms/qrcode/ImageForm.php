<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\forms\qrcode;

use common\forms\BaseForm;

/**
 * Class ShopForm
 * @package common\forms
 */
class ImageForm extends BaseForm
{

    public $url;

    public function rules()
    {
        return [
            [['url'],'required'],
        ];
    }

}
