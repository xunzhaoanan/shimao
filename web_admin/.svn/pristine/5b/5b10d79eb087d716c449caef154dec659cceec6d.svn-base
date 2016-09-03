<?php

namespace common\newforms\members;

use common\newforms\BaseForm;
use common\newservices\Member;

class GetWxCardForm extends BaseForm
{

    public $cardid;


    public function rules()
    {
        return [
            [['cardid'], 'required'],
            [['cardid'], 'string', 'max' => 50],
        ];
    }

}