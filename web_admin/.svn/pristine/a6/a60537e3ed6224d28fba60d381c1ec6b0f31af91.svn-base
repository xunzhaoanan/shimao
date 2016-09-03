<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\redpack;

use common\forms\activity\ImageTxtAddForm;
use common\forms\activity\ShareMessageAddForm;
use common\forms\BaseForm;

/**
 * @package common\forms
 */
class AddAjaxForm extends BaseForm
{
    public $redPacketEvent;
    public $activity;
    public $shareMessage;
    public $news;

    public function beforeValidate()
    {
        if (is_array($this->redPacketEvent) && count($this->redPacketEvent)) {
            $Form = new AddRedpacketRulesForm();
            $params = ['AddRedpacketRulesForm' => $this->redPacketEvent];
            $this->checkForm($params, $Form);
        } else {
            return false;
        }
        //检查图文
        if (is_array($this->news) && count($this->news)) {
            $form = new ImageTxtAddForm();
            $params = ['ImageTxtAddForm' => $this->news];
            $this->checkForm($params, $form);
        }

        //检查分享设置
        if (is_array($this->shareMessage) && count($this->shareMessage)) {
            $Form = new ShareMessageAddForm();
            $params = ['ShareMessageAddForm' => $this->shareMessage];
            $this->checkForm($params, $Form);
        }

        //检查活动设置
        if (is_array($this->activity) && count($this->activity)) {
            $Form = new AddActivityRulesForm();
            $params = ['AddActivityRulesForm' => $this->activity];
            $this->checkForm($params, $Form);
        } else {
            return false;
        }
        return true;
    }
    public function rules()
    {
        return [
            [['activity', 'redPacketEvent'], 'required'],
            [['news', 'shareMessage'], 'safe']
        ];
    }
}
