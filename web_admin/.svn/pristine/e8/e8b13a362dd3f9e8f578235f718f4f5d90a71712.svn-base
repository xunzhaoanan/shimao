<?php
/**
 * Author: Liuping
 * Date: 2015/6/15
 * Time: 11:05
 */

namespace common\forms\activity;


use common\forms\BaseForm;

class ImageTxtEditForm extends BaseForm
{
    public $title;
    public $description;
    public $content;
    public $document_id;

    public function rules()
    {
        return [
            [['title', 'description', 'document_id'], 'required'],
            [['content'], 'safe']
        ];
    }
}