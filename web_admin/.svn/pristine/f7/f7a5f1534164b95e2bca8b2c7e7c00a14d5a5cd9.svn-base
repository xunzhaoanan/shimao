<?php
/**
 * Author: Liuping
 * Date: 2015/6/15
 * Time: 11:05
 */

namespace common\forms\activity;


use common\forms\BaseForm;

class ShareMessageUpdateForm extends BaseForm
{

    public $title;
    public $desc;
    public $pic_id;

    public function rules()
    {
        return [
            [['title', 'desc'], 'string'],
            [['pic_id',], 'integer'],
        ];
    }
}