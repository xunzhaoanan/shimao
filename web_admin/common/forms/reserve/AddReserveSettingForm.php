<?php
/**
 * Author: liuPing
 * Date: 2015/7/2
 * Time: 21:58
 */

namespace common\forms\reserve;



use common\forms\BaseForm;

class AddReserveSettingForm extends BaseForm
{
    public $title;
    public $summary;
    public $note;
    public $content;
    public $items;
    public $document_id;
    public $start_time;
    public $end_time;
    public $per_count;
    public $share_type;

    public function rules()
    {
        return [
            [['title', 'summary', 'note', 'items', 'document_id'], 'required'],
            [['start_time', 'end_time', 'per_count', 'share_type'], 'integer'],
            [['summary', 'note', 'content'], 'string'],
            [['title'], 'string', 'max' => 100],
            [['document_id'], 'string', 'max' => 20]
        ];
    }
}