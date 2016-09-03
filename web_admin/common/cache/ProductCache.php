<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/10
 * Time: 15:00
 * 商品类
 */
namespace common\cache;

use common\models\Product;
use Yii;

/**
 * shop model
 */
class ProductCache extends BaseCache
{
    # 类缓存前缀
    const CACHE_KEY_PRE  = 'product_';
    # 缓存模块
    const CACHE_KEY_GET = 'get_';
    const CACHE_KEY_FIND = 'find_';
    const CACHE_KEY_FIND_CATEGORY = 'find_category_';
    const CACHE_KEY_FIND_RECOMMEND = 'find_recommend_';
    const CACHE_KEY_FIND_MOBILE = 'find_mobile_';
    const CACHE_KEY_COMMENT = 'comment_';
    const CACHE_KEY_COMMENT_AVERAFGE_POINT = 'comment_average_point';


    /**
     * 多条商品分类条记录的缓存key
     * 内部调用
     * @return mixed
     */
    private function keyFindCategory($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_FIND_CATEGORY;
        $cacheKey .= isset($params['shop_id']) ? $params['shop_id'] : null;
        return $cacheKey;
    }

    /**
     * 清除多条商品分类记录缓存
     * 注意传过来的ids是商品id是数组
     * @return mixed
     */
    public function delFindCategoryCache($params){
        $this->del($this->keyFindCategory($params));
    }

    /**
     * 设置多条商品分类记录缓存
     * @return mixed
     */
    public function setFindCategoryCache($params,$value,$expire = 3600){
        if(isset($params['pid']) && $params['pid'] !== 0 ){
            return false;
        }
        $this->set($this->keyFindCategory($params),$value);
    }

    /**
     * 获取商品分类多条记录缓存
     * @return mixed
     */
    public function getFindCategoryCache($params){
        if(isset($params['pid']) && $params['pid'] !== 0 ){
            return false;
        }
        return $this->get($this->keyFindCategory($params));
    }


    /**
     * 单条记录的缓存key
     * 内部调用
     * @return mixed
     */
    private function keyGet($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_GET;
        $cacheKey .= isset($params['product_id']) ? $params['product_id'] : null;
        return $cacheKey;
    }

    /**
     * 清除单条记录缓存
     * 注意传过来的ids是商品id是数组
     * @return mixed
     */
    public function delCache($params){
        if(isset($params['ids'])) {
            foreach ($params['ids'] as $val) {
                $params['product_id'] = $val;
                $this->del($this->keyGet($params));
            }
        }else{
            $this->del($this->keyGet($params));
        }
    }

    /**
     * 设置单条记录缓存
     * 只缓存上架的商品
     * @return mixed
     */
    public function setCache($params,$value,$expire = 108600){
        $this->set($this->keyGet($params),$value);
    }

    /**
     * 获取单条记录缓存
     * 只缓存上架的商品
     * @return mixed
     */
    public function getCache($params){
        return $this->get($this->keyGet($params));
    }

    /**
     * 多条条记录的缓存key
     * 内部调用
     * @return mixed
     */
    private function keyFind($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_FIND;
        $cacheKey .= isset($params['shop_id']) ? $params['shop_id'] : null;
        return $cacheKey;
    }

    /**
 * 清除多条记录缓存
 * 注意传过来的ids是商品id是数组
 * @return mixed
 */
    public function delFindCache($params){
        $this->del($this->keyFind($params));
    }

    /**
     * 设置多条记录缓存
     * 不缓存带有分类id的列表数据
     * 只缓存默认排序
     * 只设置第一页缓存，不然容易出错
     * @return mixed
     */
    public function setFindCache($params,$value,$expire = 108600){
        if(isset($params['product_category_id']) && ! is_null($params['product_category_id'])){
            return false;
        }
        if(isset($params['sortStr']) && array_diff($params['sortStr'],['sort'=>'asc','id'=>'desc']) || isset($params['sortStr']) && array_diff(['sort'=>'asc','id'=>'desc'],$params['sortStr']) ){
            return false;
        }
        if(isset($params['status']) && $params['status'] === Product::STATUS_ONSALE){
            if(isset($params['page']) && $params['page'] === 0) {
                $this->set($this->keyFind($params),$value);
            }
        }
        return false;
    }

    /**
     * 获取多条记录缓存
     * 不缓存带有分类id的列表数据
     * 只设置第一页缓存，不然容易出错
     * @return mixed
     */
    public function getFindCache($params){
        if(isset($params['product_category_id']) && ! is_null($params['product_category_id'])){
            return false;
        }
        if(isset($params['sortStr']) && array_diff($params['sortStr'],['sort'=>'asc','id'=>'desc']) || isset($params['sortStr']) && array_diff(['sort'=>'asc','id'=>'desc'],$params['sortStr']) ){
            return false;
        }
        if(isset($params['status']) && $params['status'] === Product::STATUS_ONSALE){
            if(isset($params['page']) && $params['page'] === 0) {
                return $this->get($this->keyFind($params));
            }
        }
        return false;
    }

    /**
     * 多条条记录的缓存key
     * 内部调用
     * @return mixed
     */
    private function keyFindRecommend($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_FIND_RECOMMEND;
        $cacheKey .= isset($params['shop_id']) ? $params['shop_id'] : null;
        return $cacheKey;
    }

    /**
     * 清除多条记录缓存
     * 注意传过来的ids是商品id是数组
     * @return mixed
     */
    public function delFindRecommendCache($params){
        $this->del($this->keyFindRecommend($params));
    }

    /**
     * 设置多条记录缓存
     * 不缓存带有分类id的列表数据
     * 只缓存默认排序
     * 只设置第一页缓存，不然容易出错
     * @return mixed
     */
    public function setFindRecommendCache($params,$value,$expire = 108600){
        if(isset($params['page']) && $params['page'] === 0) {
            $this->set($this->keyFindRecommend($params),$value);
        }
        return false;
    }

    /**
     * 获取多条记录缓存
     * 不缓存带有分类id的列表数据
     * 只设置第一页缓存，不然容易出错
     * @return mixed
     */
    public function getFindRecommendCache($params){
        if(isset($params['page']) && $params['page'] === 0) {
            return $this->get($this->keyFindRecommend($params));
        }
        return false;
    }

    /**
     * 多条评论记录的缓存key
     * 内部调用
     * @return mixed
     */
    private function keyComment($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_COMMENT;
        $cacheKey .= isset($params['product_id']) ? $params['product_id'] : null;
        return $cacheKey;
    }

    /**
     * 清除评论记录缓存
     * 注意传过来的ids是商品id是数组
     * @return mixed
     */
    public function delComment($params){
        $this->del($this->keyComment($params));
    }

    /**
     * 设置评论记录缓存
     * @return mixed
     */
    public function setComment($params,$value,$expire = 3600){
        if(isset($params['page']) && $params['page'] === 0) {
            return $this->set($this->keyComment($params),$value);
        }
        return false;
    }

    /**
     * 获取多条评论缓存
     * 不缓存带有分类id的列表数据
     * 只设置第一页缓存，不然容易出错
     * @return mixed
     */
    public function getComment($params){
        if(isset($params['page']) && $params['page'] === 0) {
            return $this->get($this->keyComment($params));
        }
        return false;
    }

    /**
     * 获取商品平均分key
     * @return mixed
     */
    private function keyAverage($params){
        $cacheKey = self::CACHE_KEY_PRE.self::CACHE_KEY_COMMENT_AVERAFGE_POINT;
        $cacheKey .= isset($params['product_id']) ? $params['product_id'] : null;
        return $cacheKey;
    }

    /**
     * 设置商品平均分
     * @return mixed
     */
    public function setCommentAverage($params,$value,$expire = 3600){
        $this->set($this->keyAverage($params),$value);
    }

    /**
     * 获取商品平均分
     * @return mixed
     */
    public function getCommentAverage($params){
        return $this->get($this->keyAverage($params));
    }

    /**
     * 删除商品平均分
     * @return mixed
     */
    public function delCommentAverage($params){
        $this->del($this->keyAverage($params));
    }


}
