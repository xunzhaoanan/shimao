<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */

namespace common\newforms\nvw;

use common\newforms\BaseForm;
use common\newservices\NewWxMessage;

class ListAjaxForm extends BaseForm
{
    public $content;
    public $mark;
    public $is_reply;
    public $user_id;

    public function rules()
    {
        return [
            [['user_id'], 'integer','min'=>0],
            [['is_reply'], 'in', 'range' => array(NewWxMessage::REPLY_YES, NewWxMessage::REPLY_NO)],
            [['mark'], 'in', 'range' => array(NewWxMessage::FAVORITES_YES, NewWxMessage::FAVORITES_NO)],
            [['content'], 'string', 'max' => '100'],
        ];
    }

}
