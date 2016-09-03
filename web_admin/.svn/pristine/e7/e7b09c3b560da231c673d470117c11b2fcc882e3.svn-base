<?php
/**
 * Author: LiuPing
 * Date: 2015/12/31
 * Time: 15:35
 */

namespace common\forms\cashredpack;

use common\forms\BaseForm;

class GroupJoinUserListAjaxForm extends BaseForm
{
    public $cash_redpack_id;
    public $keyword;
    public $type;
    public $createStart;
    public $createEnd;

    public function rules()
    {
      return [
          [['cash_redpack_id', 'type'], 'integer'],
          [['keyword', 'createStart', 'createEnd'], 'safe']
      ];
    }
}
