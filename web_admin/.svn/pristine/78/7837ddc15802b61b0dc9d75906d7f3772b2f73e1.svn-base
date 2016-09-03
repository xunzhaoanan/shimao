<?php

/**
 * Author: night
 * Date: 2015/5/8
 * Time: 10:36:16
 */

namespace common\forms;

use yii\base\Model;
use yii\base\UserException; 

/**
 * Class BaseForm
 * @package wsh\common\forms
 */
class BaseForm extends Model
{
    /**
     * 使用表单校验参数
     * @param $params
     * @param $form
     * @throws BusinessException
     */
    public function checkForm($params, $form)
    {
        if (!$form->load($params) || !$form->validate()) {
            exit('{"errcode":"-5","errmsg":'.json_encode('您提交的数据有误').'}');
        }
    }



}
