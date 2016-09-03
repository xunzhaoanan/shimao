<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\redpack;

use common\forms\BaseForm;

/**
 * @package common\forms
 */
class FindLogListAjaxForm extends BaseForm
{
    public $red_packet_event_id;
    public $red_package_item_id;

    public function rules()
    {
        return [
            [['red_packet_event_id','red_package_item_id'], 'integer','min'=>0],
        ];
    }
}
