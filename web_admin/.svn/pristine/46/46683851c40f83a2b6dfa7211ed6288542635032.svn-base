<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 15:19
 */

namespace common\forms\redpack;

use common\forms\BaseForm;
use common\models\Activity;
use common\models\Redpack;

/**
 * @package common\forms
 */
class AddRedpacketRulesForm extends BaseForm
{
    public $type;
    public $red_packet_id;
    public $red_packet_num;
    public $num_per_packet;
    public $is_attention;
    public $shop_id;
    public $shop_sub_id;


    public function rules()
    {
        return [
            [['type','red_packet_id','red_packet_num'], 'required'],
            [['type', 'red_packet_id', 'red_packet_num','num_per_packet','is_attention'], 'integer'],
            [['is_attention'], 'in', 'range' => array(Activity::YES_MUCH_SUBSCRIBE, Activity::NO_MUCH_SUBSCRIBE)],
            [['type'], function ($attribute, $param) {
                if ($this->type == Redpack::TYPE_GROUP) {
                    if (!isset($this->num_per_packet)) {
                        $this->addError($attribute, '人数/每个红包必须设置');
                    }
                } elseif ($this->type == Redpack::TYPE_TRANSMIT ) {

                } else {
                    $this->addError($attribute, 'type设置错误');
                }
            }]
        ];
    }
}
