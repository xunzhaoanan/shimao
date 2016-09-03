<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\forms\terminal;

use common\forms\BaseForm;
use common\models\Terminal;


/**
 * Class AddAjaxForm
 * @package common\forms
 */
class AddAjaxForm extends BaseForm
{
    public $lng;
    public $lat;
    public $agent_path;
    public $is_pickup_shop;
    public $shop_type;
    public $shopInfo;
    public $shopStaff;

    public function beforeValidate()
    {
        if (is_array($this->shopInfo) && count($this->shopInfo)) {
            $Form = new AddShopInfoForm();
            $params = ['AddShopInfoForm' => $this->shopInfo];
            $this->checkForm($params, $Form);
        } else {
            return false;
        }
        if (is_array($this->shopStaff) && count($this->shopStaff)) {
            $form = new AddShopStaffForm();
            $params = ['AddShopStaffForm' => $this->shopStaff];
            $this->checkForm($params, $form);
        } else {
            return false;
        }
        return true;
    }

    public function rules()
    {
        return [
            [['shopInfo','shopStaff'],'required'],
            [['shop_type', 'is_pickup_shop'], 'integer'],
            [['lng', 'lat'], 'number'],
            [['agent_path'], 'string', 'max' => 255],
            [['is_pickup_shop','shop_type'], 'safe']
        ];
    }
}



