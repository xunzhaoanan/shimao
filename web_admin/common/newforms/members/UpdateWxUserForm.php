<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class UpdateWxUserForm extends BaseForm
{

    public $nickname;
    public $sex;
    public $province;
    public $city;
    public $ountry;
    public $headimgurl;
    public $birth;
    public $email;
    public $address;
    public $member;
    public $real_name;

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
            [['sex','birth'], 'integer'],
            [['nickname'], 'string', 'max' => 45],
            [['province', 'city','real_name'], 'string', 'max' => 30],
            [['country'], 'string', 'max' => 50],
            [['email','address'], 'string', 'max' => 50],
            [['headimgurl'], 'string', 'max' => 250],
        ];
    }

}