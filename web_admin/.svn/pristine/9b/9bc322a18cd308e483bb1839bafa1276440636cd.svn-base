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
class ExportForm extends BaseForm
{
    public $id;
    public $_status;


    public function rules()
    {
        return [
            [['id'], 'required'],
            [['_status'], 'safe']
        ];
    }
}
