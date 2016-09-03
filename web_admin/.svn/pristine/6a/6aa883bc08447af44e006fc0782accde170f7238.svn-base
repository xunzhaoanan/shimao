<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */

namespace common\forms\weixin;

use common\forms\BaseForm;
use common\models\WxReply;

/**
 * @package common\forms
 */
class DiymenuEditParentsAjaxForm extends BaseForm
{
    public $id;
    public $menuname;
    public $menu_type;
    public $menu_url;

    public function rules()
    {
        return [
            [['id','menuname','menu_type'], 'required'],
            [['menu_url'],'safe']
        ];
    }
}
