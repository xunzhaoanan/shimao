<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class UpdateUserForm extends BaseForm
{

    public $id;
    public $shop_sub_id;
    public $nickname;
    public $real_name;
    public $sex;
    public $province;
    public $city;
    public $ountry;
    public $headimgurl;
    public $birth;
    public $email;
    public $address;
    public $member;
    public $county;

    public function beforeValidate()
    {
        if (isset($this->member) && is_array($this->member) && count($this->member)) {
            $form = new MemberForm();
            $this->checkForm(['MemberForm' => $this->member], $form);
        }
        return true;
    }

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['sex','id', 'birth'], 'integer'],
            [['nickname'], 'string', 'max' => 45],
            [['province', 'city','real_name'], 'string', 'max' => 30],
            [['county'], 'string', 'max' => 50],
            [['email','address'], 'string', 'max' => 50],
            [['headimgurl'], 'string', 'max' => 250],
            [['member'],'safe']
        ];
    }

}