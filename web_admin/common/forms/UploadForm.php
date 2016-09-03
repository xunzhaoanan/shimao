<?php
/**
 * Author: Kevin
 * Date: 2015/7/3
 * Time: 14:36:16
 */

namespace common\forms;


/**
 * Class ApplyAjaxForm
 * @package common\forms
 */
class UploadForm extends BaseForm
{
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file'],
        ];
    }

}



