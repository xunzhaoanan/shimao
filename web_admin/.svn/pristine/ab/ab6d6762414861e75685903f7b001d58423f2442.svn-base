<?php
/**
 * Author: Kevin
 * Date: 2015/7/3
 * Time: 14:36:16
 */

namespace common\forms\shop;
use common\forms\BaseForm;


/**
 * Class ApplyAjaxForm
 * @package common\forms
 */
class UploadCertificateForm extends BaseForm
{
    public $secret_file;
    public $key_file;

    public function rules()
    {
        return [
            [['secret_file','key_file'], 'file'],
        ];
    }

}



