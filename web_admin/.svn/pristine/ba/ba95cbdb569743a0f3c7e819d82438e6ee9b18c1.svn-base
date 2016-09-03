<?php
/**
 * Author: Liuping
 * Date: 2015/6/15
 * Time: 11:05
 */

namespace common\forms\marketactivity;


use common\forms\BaseForm;
use common\models\WxQrcode;

class ListRecodeAjaxForm extends BaseForm
{
    public $id;
    public $findName;
    public $level;
    public $template;

    public function rules()
    {
        return [
            [['id', 'template'], 'integer'],
            [['findName', 'level'], 'safe']
        ];
    }
}