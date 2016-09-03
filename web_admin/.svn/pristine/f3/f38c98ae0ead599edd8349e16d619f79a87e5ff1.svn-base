<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\forms\terminal;

use common\forms\BaseForm;
use common\models\Shop;
use common\models\Terminal;


/**
 * Class AddAjaxForm
 * @package common\forms
 */
class ScanPayAjaxForm extends BaseForm
{
    public $shop_type;

    public function rules()
    {
        return [
            [['shop_type'],'required'],
            [['shop_type'], 'range'=>[Terminal::SHOP_TYPE_STORE,Terminal::SHOP_TYPE_STORE_ITS_FRANCHISEES]],
        ];
    }
}



