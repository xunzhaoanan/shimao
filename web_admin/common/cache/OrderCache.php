<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/10
 * Time: 15:00
 * 商品类
 */
namespace common\cache;

use Yii;

/**
 * shop cache
 */
class OrderCache extends BaseCache
{

    # 缓存模块
    const WX_PAY = 'order_wx_pay_';

    const WX_PAY_DONE = 'order_wx_pay_done';


}
