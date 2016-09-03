<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\employessCode;

use common\helpers\CommonFunctionHelper;
use common\newforms\BaseForm;

class ReplyForm extends BaseForm
{

    public $reply_type;
    public $reply_params;

    public function beforeValidate()
    {
        if (is_array($this->reply_params) && CommonFunctionHelper::arrayKeyExists($this->reply_params,'id') && CommonFunctionHelper::arrayKeyExists($this->reply_params,'type')) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reply_type','reply_params'], 'required'],
            [['reply_type'], 'string', 'max' => 255],
        ];
    }

}