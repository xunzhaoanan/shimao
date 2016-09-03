<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class FindMemberDataCostSectionForm extends BaseForm
{

    public $amount_section = 10000;

    public function rules()
    {
        return [
            [['amount_section'], 'integer','min'=>100],
        ];
    }

}