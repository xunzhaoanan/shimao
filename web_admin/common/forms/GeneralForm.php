<?php
/**
 * Author: night
 * Date: 2015/6/17
 * Time: 18:46
 */

namespace common\forms;


class GeneralForm extends BaseForm
{
    public $id;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'safe']
        ];
    }
}