<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class UpdateMemberForm extends BaseForm
{

    public $id;
    public $tags;
    public $custom_field_1;
    public $custom_field_2;
    public $custom_field_3;
    public $custom_field_4;
    public $custom_field_5;
    public $member_group_id;
    public $status;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['member_group_id','status'], 'integer'],
            [['custom_field_1', 'custom_field_2', 'custom_field_3', 'custom_field_4', 'custom_field_5'], 'string', 'max' => 1000],
            [['id','tags'],'safe']
        ];
    }

}