<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class CreateConsoleDataForm extends BaseForm
{

    public $date;


    public function rules()
    {
        return [
            [['date'], 'required'],
        ];
    }

}