<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms;


class NameForm extends BaseForm
{
    public $name;

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string' , 'max'=>30],
        ];
    }
}