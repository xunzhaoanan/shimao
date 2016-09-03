<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms;


class IdsForm extends BaseForm
{
    public $ids;

    public function beforeValidate(){
        if(is_array($this->ids) && count($this->ids)){
            return true;
        }else{
            return false;
        }
    }

    public function rules()
    {
        return [
            [['ids'], 'required'],
        ];
    }
}