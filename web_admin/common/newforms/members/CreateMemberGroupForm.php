<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class CreateMemberGroupForm extends BaseForm
{

    public $name;
    public $description;
    public $sort;

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 30],
            [['sort'], 'integer'],
            [['description'], 'string', 'max' => 100],
        ];
    }

}