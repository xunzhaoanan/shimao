<?php
/**
 * Author: LiuPing
 * Date: 2015/9/2
 * Time: 15:19
 */

namespace common\forms\cardcoupon;

use common\forms\activity\ImageTxtAddForm;
use common\forms\activity\ShareMessageAddForm;
use common\forms\BaseForm;

class AddReceiveAjaxForm extends BaseForm
{

    public $card_type_id;
    public $begin_time;
    public $end_time;
    public $news;
    public $shareMessge;
    public $share_type;

    public function beforeValidate()
    {
        if (is_array($this->news) && count($this->news)) {
            $Form = new ImageTxtAddForm();
            $params = ['ImageTxtAddForm' => $this->news];
            $this->checkForm($params, $Form);
        }
        if (is_array($this->shareMessge) && count($this->shareMessge)) {
            $Form = new ShareMessageAddForm();
            $params = ['ShareMessageAddForm' => $this->shareMessge];
            $this->checkForm($params, $Form);
        }
        return true;
    }

    public function rules()
    {
        return [
            [['card_type_id', 'begin_time', 'end_time'], 'required'],
            [['news', 'shareMessge', 'share_type'], 'safe']
        ];
    }
}
