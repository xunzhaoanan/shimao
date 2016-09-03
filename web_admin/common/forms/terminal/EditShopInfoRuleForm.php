<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/15
 * Time: 14:36:16
 */

namespace common\forms\terminal;

use common\forms\BaseForm;

/**
 * Class ShopForm
 * @package common\forms
 */
class EditShopInfoRuleForm extends BaseForm
{
    public $name;
    public $phone;
    public $province_id;
    public $city_id;
    public $district_id;
    public $circle_id;
    public $address;
    public $businesshour;
    public $url;
    public $bg_img;
    public $description;
    public $theme;
    public $site_img;
    public $lbs;
    public $ewm_img;
    public $scene_id;
    public $category_del_id;

    public function rules()
    {
        return [
            [['scene_id', 'lbs', 'province_id', 'city_id', 'district_id', 'circle_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['bg_img', 'category_del_id', 'site_img', 'address', 'url'], 'string', 'max' => 255],
            [['theme', 'phone', 'businesshour'], 'string', 'max' => 20],
            [['ewm_img'], 'string', 'max' => 180]
        ];
    }
}
