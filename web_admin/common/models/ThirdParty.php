<?php
/**
 * Author: Kevin
 * Date: 2015/06/15
 * Time: 14:19
 */

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * third-party model
 */
class ThirdParty extends BaseModel
{

    //服务号
    const TYPE_SERVICE = 1;
    //订阅号
    const TYPE_SUBSCRIBE = 2;
    //开通高级接口
    const ADVANCED_INTERFACE = 1;
    //没有开通高级接口
    const UN_ADVANCED_INTERFACE = 2;

    const TYPE_WX = 1;

}
