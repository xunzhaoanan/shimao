<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\collect;


use common\forms\BaseForm;

/**
 * @package common\forms
 */
class ExchangeAjaxForm extends BaseForm
{
    public $id;
    public $collect_id;
    public $uid;


    public function rules()
    {
        return [
            [['id', 'collect_id'], 'required'],
            [['uid'], 'safe']
        ];
    }
}
