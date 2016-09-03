<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\forms\shop;

use common\forms\BaseForm;
use common\forms\terminal\EditShopInfoRuleForm;

/**
 * Class ShopForm
 * @package common\forms
 */
class ShEditAjaxForm extends BaseForm
{

    public $name;
    public $category_f;
    public $category_s;
    public $tel;
    public $website;
    public $addr;
    public $desc;
    public $bg_img;
    public $logo;
    public $after_sale_time_status;
    public $after_sale_handle_time;
    public $return_address;
    public $return_consignee;
    public $return_phone;


    public function rules()
    {
        return [
            [['name', 'category_f', 'category_s', 'tel', 'website', 'addr', 'desc', 'bg_img', 'logo', 'after_sale_time_status', 'after_sale_handle_time', 'return_address', 'return_consignee', 'return_phone'], 'safe']
        ];
    }
}
