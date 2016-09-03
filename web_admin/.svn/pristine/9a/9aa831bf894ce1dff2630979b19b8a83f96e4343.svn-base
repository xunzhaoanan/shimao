<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class CreateMemberGradeForm extends BaseForm
{

    public $name;
    public $remark;
    public $discount;
    public $face_document_id;
    public $growth;

    public function rules()
    {
        return [
            [[ 'name','face_document_id', 'growth'], 'required'],
            [[ 'face_document_id','discount','growth'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['remark'], 'string', 'max' => 100],
        ];
    }

}