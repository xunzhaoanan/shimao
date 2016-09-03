<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\employessCode;

use common\newforms\BaseForm;

class AddEmployeePolicyAjaxForm extends BaseForm
{

    public $name;
    public $push_type;
    public $shop_sub_id;
    public $reply;
    public $start_time;
    public $end_time;
    public $peopleList;
    public $storeList;
    public $deleted;

    public function beforeValidate()
    {
        if (is_array($this->reply) && count($this->reply)) {
            $form = new ReplyForm();
            foreach($this->reply as $val) {
                $this->checkForm(['ReplyForm' => $val], $form);
            }
        }else{
            return false;
        }
        if ( ! is_array($this->peopleList) &&  ! is_array($this->storeList)) {
            return false;
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_time', 'end_time','deleted','name','push_type','reply'], 'required'],
            [['start_time','push_type', 'end_time','deleted'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['peopleList','storeList'], 'safe'],
        ];
    }

}