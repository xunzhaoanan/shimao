<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\collect;

use common\forms\BaseForm;
use common\models\Collect;

/**
 * @package common\forms
 */
class EditCollectRulesForm extends BaseForm
{
    public $id;
    public $name;
    public $is_attention;
    public $start_time;
    public $end_time;
    public $document_id;
    public $share_type;

    public function rules()
    {
        return [
            [['id', 'name', 'start_time', 'end_time'], 'required'],
            [['is_attention', 'start_time', 'end_time', 'document_id', 'share_type'], 'integer']
        ];
    }

}
