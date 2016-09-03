<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\employessCode;

use common\newforms\BaseForm;

class GetPolicyForm extends BaseForm
{

    public $id;
    public $shop_id;

    public function rules()
    {
        return [
            [['id','shop_id'], 'required'],
            [['id', 'shop_id'], 'integer']
        ];
    }

}