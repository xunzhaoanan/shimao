<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/25
 * Time: 20:05
 */

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * WxMenu model
 */
class SelectModel extends BaseModel
{


    // 模块类型
    const TYPE_COLLECT_RECEIVE = 1 ;
    const TYPE_COLLECT_ZAN = 2 ;
    const TYPE_SECONDKILL = 3 ;
    const TYPE_RESERVE = 4 ;
    const TYPE_REDPACK = 5 ;
    const MODEL_MARKETING = 6 ;
    const MODEL_SMASHEGG = 7 ;
    const MODEL_CARD_COUPON = 8 ;
    const MODEL_TOGETHER_BUY = 9 ;

    public static $modelType = [
        self::MODEL_MARKETING ,
        self::TYPE_SECONDKILL ,
        self::TYPE_REDPACK ,
        self::TYPE_RESERVE,
        self::TYPE_COLLECT_RECEIVE ,
        self::TYPE_COLLECT_ZAN ,
        self::MODEL_SMASHEGG,
        self::MODEL_CARD_COUPON,
        self::MODEL_TOGETHER_BUY
    ];



}
