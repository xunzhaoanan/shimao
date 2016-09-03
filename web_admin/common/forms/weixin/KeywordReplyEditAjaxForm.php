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
class KeywordReplyEditAjaxForm extends BaseForm
{
    public $id;
    public $keyword;
    public $reply_ids;
    public $match_type;

    public function rules()
    {
        return [
            [['id','match_type','keyword','reply_ids'], 'required'],
            [['match_type'],'in','range'=>[WxReply::MATCH_ALL,WxReply::MATCH_INCLUDE] ]
        ];
    }
}
