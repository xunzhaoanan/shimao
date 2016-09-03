<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\collect;


use common\forms\activity\ImageTxtAddForm;
use common\forms\activity\ShareMessageAddForm;
use common\forms\BaseForm;
use common\models\Collect;

/**
 * @package common\forms
 */
class AddCollectAjaxForm extends BaseForm
{
    public $name;
    public $is_attention;
    public $start_time;
    public $end_time;
    public $document_id;

    public function rules()
    {
        return [
            [['name', 'is_attention', 'start_time', 'end_time'], 'required'],
            [['shop_id', 'is_attention', 'start_time', 'end_time', 'document_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['is_attention'], 'in', 'range' => [Collect::FORCE_ATTENTION_YES, Collect::FORCE_ATTENTION_NO]]
        ];
    }

}
