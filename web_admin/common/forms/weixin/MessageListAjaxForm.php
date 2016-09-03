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
class MessageListAjaxForm extends BaseForm
{
    public $content;
    public $type;
    public $user_id;

    public function rules()
    {
        return [
            [['content','type','user_id'], 'safe']
        ];
    }
}
