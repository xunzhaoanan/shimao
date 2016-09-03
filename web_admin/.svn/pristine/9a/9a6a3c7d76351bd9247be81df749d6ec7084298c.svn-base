<?php
/**
 * Author: Liuping
 * Date: 2015/01/20
 * Time: 20:00
 * 活动缓存
 */
namespace common\cache;

use Yii;

/**
 * activity cache
 */
class ActivityCache extends BaseCache
{

    # 类缓存前缀
    const CACHE_KEY_PRE = 'activity_';
    # 缓存模块 扫码
    const CACHE_KEY_SCAN = 'scan_';


    /**
     * 获取单条数据缓存key
     * @return mixed
     */
    private function scanGetKey($params) {
        $cacheKey = self::CACHE_KEY_PRE . self::CACHE_KEY_SCAN;
        $cacheKey .= isset($params['type']) ? $params['type'] : null; //活动类型
        $cacheKey .= isset($params['shop_id']) ? $params['shop_id'] : null;
        $cacheKey .= isset($params['id']) ? $params['id'] : null;  //活动id

        return $cacheKey;
    }

    /**
     * 清除单条数据缓存
     * @return mixed
     */
    public function delActivityScan($params) {
        $this->del($this->scanGetKey($params));
    }

    /**
     * 设置数据缓存
     * 写入缓存是追加的方式，数据存入同一key对应的数组里
     * @return mixed
     */
    public function setActivityScan($params, $value, $expire = 172800) {
        if (!$this->isScanActivity($params, $value)) {
            if ($cache = $this->getActivityScan($params)) {
                $cache[] = $value;
            } else {
                $cache = [$value];
            }
            $this->set($this->scanGetKey($params), $cache, $expire);
        }
    }

    /**
     * 获取扫二维码缓存key对应的数据缓存
     * @return mixed
     */
    public function getActivityScan($params) {
        $cache = $this->get($this->scanGetKey($params));
        if ($cache && is_array($cache)) {
            return $cache;
        }
        return null;
    }

    /**
     * 是否扫过活动二维码
     * 通过判断值是否存在缓存key对应的数组值里
     * @return mixed
     */
    public function isScanActivity($params, $value) {
        $cache = $this->getActivityScan($params);
        if ($cache && in_array($value, $cache)) {
            return true;
        }
        return false;
    }
}
