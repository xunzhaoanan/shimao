<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class SyncDataToWxForm extends BaseForm
{

    public $wx_code;


    public function rules()
    {
        return [
            [['wx_code'], 'required'],
            [['wx_code'], 'string', 'max' => 50],
        ];
    }

}