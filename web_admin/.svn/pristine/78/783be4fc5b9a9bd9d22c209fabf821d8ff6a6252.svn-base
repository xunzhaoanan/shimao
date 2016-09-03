<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class FindMemberForm extends BaseForm
{

    public $keyword;
    public $level;
    public $real_name;
    public $bind_mobile;
    public $status;
    public $is_get_card;
    public $source;
    public $member_group_id;
    public $member_tag_id;
    public $tags;
    public $sex;
    public $province;
    public $city;
    public $email;
    public $county;
    public $create_start;
    public $create_end;
    public $id;


    public function rules()
    {
        return [
            [['sex','status','id','member_tag_id','member_group_id','source','level','province','city','county','tags'], 'safe'],
            [['real_name'], 'string', 'max' => 30],
            [['email'], 'string', 'max' => 50],
            [['bind_mobile','keyword'], 'string', 'max' => 20],
            [['create_start','create_end','is_get_card'], 'integer'],
        ];
    }

}