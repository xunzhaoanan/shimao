<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\secondkill;

use common\forms\activity\ImageTxtEditForm;
use common\forms\activity\PostageSettingEditForm;
use common\forms\BaseForm;
use common\forms\product\ShareMessageEditForm;

/**
 * @package common\forms
 */
class EditAjaxForm extends BaseForm
{
    public $secondKill;
    public $activity;
    public $postageSetting;
    public $shareMessage;
    public $news;

    public function beforeValidate()
    {
        if (is_array($this->secondKill) && count($this->secondKill)) {
            $Form = new SecondKillEditRulesForm();
            $params = ['SecondKillEditRulesForm' => $this->secondKill];
            $this->checkForm($params, $Form);
        } else {
            return false;
        }
        //检查活动设置
        if (is_array($this->activity) && count($this->activity)) {
            $Form = new ActivityEditRulesForm();
            $params = ['ActivityEditRulesForm' => $this->activity];
            $this->checkForm($params, $Form);
        } else {
            return false;
        }
        //检查邮费设置
        if (is_array($this->postageSetting) && count($this->postageSetting)) {
            $Form = new PostageSettingEditForm();
            $params = ['PostageSettingEditForm' => $this->postageSetting];
            $this->checkForm($params, $Form);
        }
        //检查分享设置
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
            [['secondKill', 'activity'], 'required'],
            [['postageSetting', 'shareMessage','news'],'safe']
        ];
    }
}
