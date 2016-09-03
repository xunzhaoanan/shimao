<?php
/**
 * Author: LiuPing
 * Date: 2016/05/16
 * Time: 13:30
 */

namespace common\newforms\reduction;

use common\newforms\BaseForm;

class UpdateReductionForm extends BaseForm
{
    public $id;
    public $name;
    public $is_relate_all;
    public $start_time;
    public $end_time;

    public function rules()
    {
        return [
            [['id', 'name', 'is_relate_all','start_time','end_time'], 'required'],
            [['start_time','end_time', 'is_relate_all'], 'integer', 'min' => 1],
            [['name'], 'string', 'max' => 255]
        ];
    }
}