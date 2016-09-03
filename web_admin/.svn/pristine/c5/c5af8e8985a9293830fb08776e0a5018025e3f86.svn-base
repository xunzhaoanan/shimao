<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\signin;

use common\forms\BaseForm;

/**
 * @package common\forms
 */
class EditAjaxForm extends BaseForm
{
    public $id;
    public $name;
    public $pic_url;
    public $limit_count;
    public $start_time;
    public $end_time;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['start_time', 'end_time'], 'integer'],
            [['name', 'pic_url'], 'string', 'max' => 250],
            [['limit_count'], 'integer', 'min' => 0]
        ];
    }
}
