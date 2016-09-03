<?php
/**
 * Author: LiuPing
 * Date: 2015/06/29
 * Time: 10:55
 */
namespace common\models;

use common\cache\MallCache;
use Yii;

/**
 * Mall model
 */
class Mall extends BaseModel
{

    protected $mallCache ;

    public function init()
    {
        $this->mallCache = new MallCache();
    }

    /**
     * TODO 更新终端店
     */
    public function terminalUpdate($params){
        $apiParams = $params;
        $this->getResult('terminal-update',$apiParams);
    }

    /**
     * TODO 删除终端店
     */
    public function terminalDel($params){
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'navigation_id' => isset($params['product_id']) ? $params['product_id'] : null
        ];
        $this->getResult('terminal-del',$apiParams);
    }


}
