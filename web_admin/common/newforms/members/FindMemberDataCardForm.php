<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class FindMemberDataCardForm extends BaseForm
{

    public $time_start;
    public $time_end;

    public function rules()
    {
        return [
            [['time_start','time_end'], 'required'],
            [['time_start','time_end'], 'integer', 'min' => 0],
        ];
    }

}