<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 */

namespace common\newforms\members;

use common\newforms\BaseForm;

class UpdateMemberCardShareMessageForm extends BaseForm
{

    public $id;
    public $title;
    public $desc;
    public $pic_id;

    public function rules()
    {
        return [
            [['id','title', 'desc','pic_id'],'required'],
            [['title', 'desc'], 'string'],
            [['pic_id','id'], 'integer'],
        ];
    }

}