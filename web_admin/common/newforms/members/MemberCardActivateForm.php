<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class MemberCardActivateForm extends BaseForm
{

    public $content;


    public function rules()
    {
        return [
            [['content'], 'safe'],
        ];
    }

}