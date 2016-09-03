<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class UpdateMemberCardForm extends BaseForm
{

    public $logo_url;
    public $color;
    public $description;
    public $prerogative;
    public $code_type;
    public $service_phone;
    public $location_id_list;
    public $title;
    public $notice;
    public $brand_name;
    public $custom_url_name;
    public $custom_url;
    public $custom_url_sub_title;
    public $promotion_url_name;
    public $promotion_url;
    public $promotion_url_sub_title;
    public $custom_cell1_name;
    public $custom_cell1_url;
    public $custom_cell1_tips;
    public $memberCardActivateSetting;

    public function beforeValidate()
    {
        if (is_array($this->memberCardActivateSetting) && count($this->memberCardActivateSetting)) {
            $form = new MemberCardActivateSettingForm();
            $this->checkForm(['MemberCardActivateSettingForm' => $this->memberCardActivateSetting], $form);
        }else{
            return false;
        }
        return true;
    }

    public function rules()
    {
        return [
            [['memberCardActivateSetting','title','logo_url','color','code_type','notice','brand_name','description','prerogative'], 'required'],
            [['location_id_list'], 'safe'],
            [['title'], 'string', 'max' => 30],
            [['brand_name'], 'string', 'max' => 12],
            [['notice'], 'string', 'max' => 16],
            [['logo_url'], 'string', 'max' => 100],
            [['color', 'service_phone'], 'string', 'max' => 50],
            [['description','prerogative'], 'string', 'max' => 1024],
            [['code_type'], 'string', 'max' => 20],
            [['custom_url_name', 'promotion_url_name', 'custom_cell1_name'], 'string', 'max' => 5],
            [['custom_url', 'promotion_url', 'custom_cell1_url'], 'string', 'max' => 128],
            [['custom_url_sub_title', 'promotion_url_sub_title', 'custom_cell1_tips'], 'string', 'max' => 6],
        ];
    }

}