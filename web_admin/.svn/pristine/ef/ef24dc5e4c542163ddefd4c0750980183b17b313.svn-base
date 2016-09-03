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
class EditAjaxForm extends BaseForm
{
    public $id;
    public $shop_id;
    public $lng;
    public $lat;
    public $shop_path;
    public $is_pickup_shop;
    public $shop_type;
    public $shopInfo;

    public function beforeValidate()
    {
        if (is_array($this->shopInfo) && count($this->shopInfo)) {
            $Form = new EditShopInfoRuleForm();
            $params = ['EditShopInfoRuleForm' => $this->shopInfo];
            $this->checkForm($params, $Form);
        }else{
            return false;
        }
        return true;
    }

    public function rules()
    {
        return [
            [['id','shop_id'], 'required'],
            [['lng','lat', 'shop_path', 'is_pickup_shop','shop_type','shopInfo'], 'safe']
        ];
    }
}
