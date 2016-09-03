<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class UpdateMemberGroupForm extends BaseForm
{

    public $id;
    public $name;
    public $description;
    public $sort;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id','sort'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['description'], 'string', 'max' => 100],
        ];
    }

}