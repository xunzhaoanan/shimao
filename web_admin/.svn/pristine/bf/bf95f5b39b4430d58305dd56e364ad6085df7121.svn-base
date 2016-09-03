<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class UpdateMemberTagForm extends BaseForm
{

    public $id;
    public $name;
    public $sort;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['sort'], 'integer'],
        ];
    }

}