<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\employessCode;

use common\newforms\BaseForm;

class PolicyRelationStaffListAjaxForm extends BaseForm
{

    public $id;

    public function rules()
    {
        return [
            [['id'], 'integer']
        ];
    }

}