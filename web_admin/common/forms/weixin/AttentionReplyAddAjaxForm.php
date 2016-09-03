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
class AttentionReplyAddAjaxForm extends BaseForm
{
    public $reply_ids;

    public function rules()
    {
        return [
            [['reply_ids'], 'required']
        ];
    }
}
