<?php
/**
 * Author: LiuPing
 * Date: 2015/12/31
 * Time: 15:35
 */

namespace common\forms\cashredpack;

use common\forms\BaseForm;

class SendListAjaxForm extends BaseForm
{
    public $cash_redpack_id;
    public $status; //发放状态：1发放失败，2未领取，3已领取，4已退款
    public $keyword;
    public $type;
    public $_source;
    public $wx_keyword;
    public $group_id;
    public $createStart;
    public $createEnd;

    public function rules()
    {
        return [
            [['cash_redpack_id', 'status', '_source', 'type', 'group_id'], 'integer'],
            [['keyword', 'wx_keyword', 'createStart', 'createEnd'], 'safe']
        ];
    }
}
