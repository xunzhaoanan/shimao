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
class AddCustomGiftAjaxForm extends BaseForm
{
    public $collect_id;
    public $name;
    public $document_id;
    public $give;
    public $number;
    public $price;
    public $count;
    public $lastCount;

    public function rules()
    {
        return [
            [['name', 'document_id', 'collect_id', 'number', 'count', 'lastCount', 'price'], 'required'],
            [['document_id', 'collect_id', 'give', 'number', 'count', 'lastCount'], 'integer'],
            [['name'], 'string']
        ];
    }
}
