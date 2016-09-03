<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */

namespace common\forms\weixin;

use common\forms\BaseForm;
use common\models\WxReply;

/**
 * @package common\forms
 */
class QrcodeAddAjaxForm extends BaseForm
{
    public $model;
    public $model_id;
    public $type;
    public $type_id;

    public function rules()
    {
        return [
            [['model','model_id','type','type_id'], 'required'],
        ];
    }
}
