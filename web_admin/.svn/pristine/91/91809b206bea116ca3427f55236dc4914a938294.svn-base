<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\collect;


use common\forms\BaseForm;

/**
 * @package common\forms
 */
class EditCustomGiftAjaxForm extends BaseForm
{
    public $id;
    public $collect_id;
    public $name;
    public $document_id;
    public $give;
    public $number;
    public $price;
    public $count;

    public function rules()
    {
        return [
            [['id', 'name', 'document_id', 'collect_id', 'number', 'count', 'price'], 'required'],
            [['document_id', 'collect_id', 'give', 'number', 'count'], 'integer'],
            [['name'], 'string']
        ];
    }
}
