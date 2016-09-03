<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2016/6/1
 * Time: 15:52
 */
namespace common\newforms\members;

use common\newforms\BaseForm;

class ShopListForm extends BaseForm
{
    public $lng;
    public $lat;

    public function rules()
    {
        return [
            [['lng'],'double'],
            [['lat'],'double']
        ];
    }
}