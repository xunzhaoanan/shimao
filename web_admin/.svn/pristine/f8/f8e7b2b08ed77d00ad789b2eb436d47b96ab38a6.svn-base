<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms;


class IdNameForm extends BaseForm
{
    public $id;
    public $name;

    public function rules()
    {
        return [
            [['id','name'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string','max'=>100]
        ];
    }
}