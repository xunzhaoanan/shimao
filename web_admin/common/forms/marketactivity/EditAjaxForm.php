<?php
/**
 * Author: LiuPing
 * Date: 2015/7/1
 * Time: 14:36:16
 */

namespace common\forms\marketactivity;

use common\forms\activity\ImageTxtEditForm;
use common\forms\activity\ShareMessageUpdateForm;
use common\forms\BaseForm;

class EditAjaxForm extends BaseForm
{
    public $id;
    public $template;
    public $buy_limit;
    public $start_time;
    public $end_time;
    public $try_limit;
    public $limit_type;
    public $expiry_time;
    public $winning_limit;
    public $share_award;
    public $activity_name;
    public $sorry_word;
    public $logo_img;
    public $activity_desc;
    public $startNews;
    public $shareMessage;
    public $extend;
    public $prize;
    public $points_count;
    public $use_points;
    public $points_num;
    public $is_subscribe;
    public $share_type;

    public function beforeValidate()
    {
        //检查图文
        if (is_array($this->startNews) && count($this->startNews)) {
            $form = new ImageTxtEditForm();
            $params = ['ImageTxtEditForm' => $this->startNews];
            $this->checkForm($params, $form);
        }
        //检查分享设置
        if (is_array($this->shareMessage) && count($this->shareMessage)) {
            $Form = new ShareMessageUpdateForm();
            $params = ['ShareMessageUpdateForm' => $this->shareMessage];
            $this->checkForm($params, $Form);
        }

        if (is_array($this->extend) && count($this->extend)) {
            $Form = new CreateExtendForm();
            $params = ['CreateExtendForm' => $this->extend];
            $this->checkForm($params, $Form);
        }
        if (is_array($this->prize) && count($this->prize)) {
            foreach ($this->prize as $pvo) {
                $Form = new CreatePrizeForm();
                $params = ['CreatePrizeForm' => $pvo];
                $this->checkForm($params, $Form);
            }
        }
        return true;
    }

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'template', 'buy_limit', 'start_time', 'end_time', 'try_limit', 'expiry_time', 'winning_limit', 'share_award', 'use_points', 'points_count', 'points_num', 'is_subscribe', 'limit_type', 'share_type'], 'integer', 'min' => 0],
            [['activity_name', 'sorry_word'], 'string', 'max' => 100],
            [['logo_img'], 'string', 'max' => 150],
            [['activity_desc'], 'string', 'max' => 300],
            [['startNews', 'shareMessage', 'extend', 'prize'], 'safe']
        ];
    }
}
