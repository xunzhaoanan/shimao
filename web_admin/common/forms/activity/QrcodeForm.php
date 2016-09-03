<?php
/**
 * Author: Liuping
 * Date: 2015/6/15
 * Time: 11:05
 */

namespace common\forms\activity;


use common\forms\BaseForm;
use common\models\WxQrcode;

class QrcodeForm extends BaseForm
{
    public $model;
    public $model_id;

    public function rules()
    {
        return [
            [['model', 'model_id'], 'required'],
            [['model'], 'in','range' => WxQrcode::$qrcodeModel]
        ];
    }
}