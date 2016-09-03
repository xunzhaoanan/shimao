<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/10
 * Time: 15:00
 * 商品类
 */
namespace common\cache;

use common\models\Activity;
use Yii;

/**
 * shop cache
 */
class PointRedeemCache extends BaseCache
{

    # 类缓存前缀
    const CACHE_KEY_PRE  = 'pointredeem_';
    # 缓存模块
    const CACHE_KEY_FIND = 'find_';


    /**
     * 获取单条数据缓存key
     * @return mixed
     */
    private function findKey($params){
        //拿缓存数组
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_FIND;
        $cacheKey .= isset($params['shop_id']) ? $params['shop_id'] : null;
        return $cacheKey;
    }

    /**
     * 清除单条数据缓存
     * @return mixed
     */
    public function delFind($params){
        $this->del($this->findKey($params));
    }

    /**
     * 设置单条数据缓存
     * @return mixed
     */
    public function setFind($params,$value,$expire = 86400){
        if(isset($params['deleted']) && $params['deleted'] == Activity::STATUS_OPEN){
            $this->set($this->findKey($params),$value);
        }
    }

    /**
     * 获取单条数据缓存
     * @return mixed
     */
    public function getFind($params){
        if(isset($params['deleted']) && $params['deleted'] == Activity::STATUS_OPEN){
            return $this->get($this->findKey($params));
        }
        return false;
    }





}
