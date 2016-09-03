<?php
/**
 * Author: Liuping
 * Date: 2015/6/15
 * Time: 11:05
 */

namespace common\forms\activity;


use common\forms\BaseForm;
use common\models\WxQrcode;

class ListAjaxForm extends BaseForm
{
    public $deleted;
    public $id;
    public $_name;
    public $valid; //卡券，列出有效卡券列表

    public function rules()
    {
        return [
            [['deleted'], 'integer'],
            [['_name', 'valid','id'], 'safe']
        ];
    }
}