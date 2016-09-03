<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class SyncWxCardForm extends BaseForm
{

    public $content;
    public $id;


    public function rules()
    {
        return [
            [['content'], 'safe'],
            [['id'], 'required'],
            [['id'], 'integer'],
        ];
    }

}