<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms;


class ListForm extends BaseForm
{
    public $name;
    public $type;

    public function rules()
    {
        return [
            [['name'], 'string','max'=>30],
            [['type'], 'integer']
        ];
    }
}