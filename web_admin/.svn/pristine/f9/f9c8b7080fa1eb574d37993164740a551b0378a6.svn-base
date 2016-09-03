<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms;


class CheckMobileCodeForm extends BaseForm
{
    public $code;
    public $mobile;

    public function rules()
    {
        return [
            [['code','mobile'], 'required'],
            [['code','mobile'], 'string'],
        ];
    }
}