<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class PointFlowRecordAjaxForm extends BaseForm
{
    public $type;//类型
    public $count = 20;
    public $page = 0;
    public $sortStr;
    public $createStart;
    public $createEnd;
    public $changeType;
    public $order_no;
    public $activity_name;
    public $real_name;
    public $bind_mobile;

    public function rules()
    {
        return [
            [[ 'type', 'page', 'createStart', 'createEnd'], 'integer'],
            [['changeType'], 'in', 'range' => [1, 2]],
            [['order_no', 'activity_name', 'real_name', 'bind_mobile'], 'string', 'min' => 1],
            [['count'], 'integer', 'min' => 1, 'max' => 2000],
            [['sortStr'], 'safe']
        ];
    }

}