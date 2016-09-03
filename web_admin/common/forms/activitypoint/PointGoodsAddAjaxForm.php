<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\activitypoint;

use common\forms\BaseForm;

/**
 * @package common\forms
 */
class PointGoodsAddAjaxForm extends BaseForm
{

//TODO
    public function rules()
    {
        return [
            [[], 'required']
        ];
    }
}
