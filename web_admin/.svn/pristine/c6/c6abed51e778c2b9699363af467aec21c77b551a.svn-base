<?php
/**
 * Author: LiuPing
 * Date: 2015/7/1
 * Time: 14:36:16
 */

namespace common\forms\activity;

use app\common\forms\activity\ImageTxtAddForm;
use common\forms\BaseForm;

class AddAjaxForm extends BaseForm
{
    public $activity;
    public $news;

    public function beforeValidate()
    {
        //检查活动设置
        if (is_array($this->activity) && count($this->activity)) {
            $Form = new ActivityAddRulesForm();
            $params = ['ActivityAddRulesForm' => $this->activity];
            $this->checkForm($params, $Form);
        } else {
            return false;
        }

        if (is_array($this->news) && count($this->news)) {
            $Form = new ImageTxtAddForm();
            $params = ['ImageTxtAddForm' => $this->news];
            $this->checkForm($params, $Form);
        } else {
            return false;
        }

        return true;
    }

    public function rules()
    {
        return [
            [['activity', 'news'], 'required']
        ];
    }
}
