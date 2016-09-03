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
class DiymenuAddAjaxForm extends BaseForm
{
    public $menuname;
    public $pid;
    public $menu_type;
    public $menu_url;
    public $sort;
    public $display;

    public function rules()
    {
        return [
            [['menuname','pid','menu_type','menu_url'], 'required'],
            [['sort'],'safe']
        ];
    }
}
