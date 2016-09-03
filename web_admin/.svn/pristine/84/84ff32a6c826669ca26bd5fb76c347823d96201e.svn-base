<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms;

use yii\base\Model;
use common\helpers\JsApiHelper;

class BaseForm extends Model
{
    /**
     * 使用表单校验参数
     */
    public function checkForm($params, $form)
    {
        if (!$form->load($params) || !$form->validate()) {
            JsApiHelper::setError('您提交的数据有误','-1');
        }
    }


}
