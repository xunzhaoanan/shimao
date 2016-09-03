<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/10
 * Time: 15:00
 * 商品类
 */
namespace common\cache;

use common\vendor\request\RequestLib;
use Yii;

/**
 * shop model
 */
class DocumentCache extends BaseCache
{
    # 类缓存前缀
    const CACHE_KEY_PRE  = 'document_';
    # 缓存模块
    const CACHE_KEY_PAYMENT_LIST = 'list_';


    /**
     * 文件列表缓存key
     * 内部调用
     * @return mixed
     */
    private function listKey($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_PAYMENT_LIST;
        $cacheKey .= isset($params['shop_id']) ? $params['shop_id'] : null;
        $cacheKey .= '_';
        $cacheKey .= isset($params['file_type']) ? $params['file_type'] : null;
        return $cacheKey;
    }

    /**
     * 清除文件列表缓存
     * @return mixed
     */
    public function delCache($params){
        $this->del($this->listKey($params));
    }

    /**
     * 设置文件列表缓存
     * @return mixed
     */
    public function setCache($params,$value,$expire = 86400){
        if($params['page'] === 0) {
            $this->set($this->listKey($params), $value, $expire);
        }
    }

    /**
     * 获取文件列表缓存
     * 由于缓存无法全部更新机制，所以只能缓存第一页
     * @return mixed
     */
    public function getCache($params){
        if($params['page'] === 0) {
            return $this->get($this->listKey($params));
        }else{
            return false;
        }
    }

}
