<?php
/**
 * Author: Kevin
 * Date: 2015/6/23
 * Time: 14:36:16
 */

namespace common\forms\terminal;

use common\forms\BaseForm;

/**
 * Class ProductForm
 * @package common\forms
 */
class ListAjaxForm extends BaseForm
{

    public $is_search;
    public $is_all;

    //员工列表
    public $real_name;
    public $role_id;
    public $shop_sub_id;

    //终端店列表
    public $city_id;
    public $district_id;
    public $province_id;
    public $name;
    public $shop_type;
    public $ids;
    public $search_all;
    public $qrcode_policy_id;
    public $isShowQrcodePolicy;

    //搜索门店列表 最多100个
    public $count;

    public function rules()
    {
        return [
            [['qrcode_policy_id','isShowQrcodePolicy','real_name','search_all','shop_type','ids','is_search','role_id','shop_sub_id','city_id','province_id','name','district_id','is_all','count'], 'safe'],
        ];
    }
}
