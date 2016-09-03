<?php
/**
 * Author: LiuPing
 * Date: 2015/07/1
 * Time: 10:23
 */

namespace common\forms\reserve;

use common\forms\activity\ImageTxtEditForm;
use common\forms\BaseForm;
use common\forms\product\ShareMessageEditForm;

/**
 * @package common\forms
 */
class EditAjaxForm extends BaseForm
{
    public $shareMessage;
    public $reserveSetting;
    public $news;

    public function beforeValidate()
    {
        //检查预约活动设置
        if (is_array($this->reserveSetting) && count($this->reserveSetting)) {
            $Form = new EditReserveSettingForm();
            $params = ['EditReserveSettingForm' => $this->reserveSetting];
            $this->checkForm($params, $Form);
        } else {
            return false;
        }
        //TODO 现在页面暂未有分享设置
        if (is_array($this->shareMessage) && count($this->shareMessage)) {
            $Form = new ShareMessageEditForm();
            $params = ['ShareMessageEditForm' => $this->shareMessage];
            $this->checkForm($params, $Form);
        }

        //检查图文设置
        if (is_array($this->news) && count($this->news)) {
            $Form = new ImageTxtEditForm();
            $params = ['ImageTxtEditForm' => $this->news];
            $this->checkForm($params, $Form);
        }
        return true;
    }

    public function rules()
    {
        return [
            [['reserveSetting'], 'required'],
            [['shareMessage', 'news'], 'safe']
        ];
    }
}
