<?php
/**
 * Author: LiuPing
 * Date: 2016/03/22
 * Time: 15:19
 */

namespace common\forms\signin;

use common\forms\BaseForm;
use common\forms\redpack\AddActivityRulesForm;

/**
 * @package common\forms
 */
class AddAjaxForm extends BaseForm
{
    public $name;
    public $pic_url;
    public $limit_count;
    public $start_time;
    public $end_time;

    public function rules()
    {
        return [
            [['name', 'start_time', 'end_time'], 'required'],
            [['start_time', 'end_time'], 'integer'],
            [['name', 'pic_url'], 'string', 'max' => 250],
            [['limit_count'], 'integer', 'min' => 0]
        ];
    }
}
