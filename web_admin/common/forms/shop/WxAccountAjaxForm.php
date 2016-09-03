<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\forms\shop;

use common\forms\BaseForm;

/**
 * Class WxAccountAjaxForm
 * @package common\forms
 */
class WxAccountAjaxForm extends BaseForm
{
    public $token;
    public $appid;
    public $secret;

    public function rules()
    {
        return [
            [['token', 'appid', 'secret'], 'required'],
        ];
    }

}
