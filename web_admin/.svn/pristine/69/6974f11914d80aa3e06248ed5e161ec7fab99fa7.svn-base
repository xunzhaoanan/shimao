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
class QrcodeDetailAjaxForm extends BaseForm
{

    public $model;
    public $model_id;
    public $shop_sub_id;
    public $auto_build = true;

    public function rules()
    {
        return [
            [['model','model_id'],'required'],
            [['auto_build','shop_sub_id'], 'safe'],
        ];
    }

}
