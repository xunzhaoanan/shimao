<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class UpdateMemberGradeForm extends BaseForm
{

    public $id;
    public $name;
    public $remark;
    public $discount;
    public $face_document_id;
    public $growth;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['face_document_id','discount','growth','id'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['remark'], 'string', 'max' => 100],
        ];
    }

}