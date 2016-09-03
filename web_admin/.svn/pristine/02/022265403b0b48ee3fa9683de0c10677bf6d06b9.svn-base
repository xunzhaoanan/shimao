<?php
/**
 * Author: liuPing
 * Date: 2015/7/2
 * Time: 21:58
 */

namespace common\forms\reserve;


use common\forms\BaseForm;

class EditReserveSettingForm extends BaseForm
{
    public $id;
    public $title;
    public $summary;
    public $note;
    public $content;
    //public $items; 编辑时不能修改item
    public $start_time;
    public $end_time;
    public $per_count;
    public $document_id;
    public $share_type;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['start_time', 'end_time', 'per_count', 'share_type'], 'integer'],
            [['title', 'summary', 'note', 'document_id','content'], 'safe'],
            [['summary', 'note', 'content'], 'string'],
            [['title'], 'string', 'max' => 100],
            [['document_id'], 'string', 'max' => 20]
        ];
    }
}