<?php
/**
 * Author: Kevin
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

/**
 * Class FindMemberDiscountedProductForm
 * @package common\forms
 */
class FindMemberDiscountedProductForm extends BaseForm
{
    public $count = 20;
    public $page = 0;

    public function rules()
    {
        return [
            [['page'], 'integer', 'min' => 0],
            [['count'], 'integer', 'min' => 1, 'max' => 2000]
        ];
    }
}