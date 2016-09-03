<?php
/**
 * Author: zhangjn
 * Date: 2016/4/7
 * Time: 15:14
 */

namespace common\forms\shop;

use common\forms\BaseForm;

/**
 * Class StatementRateUpdateForm
 * @package common\forms\shop
 */
class StatementRateUpdateForm extends BaseForm
{
    public $statement_rate;

    public function rules()
    {
        return [
            [['statement_rate'], 'number', 'max' => 100]
        ];
    }
}