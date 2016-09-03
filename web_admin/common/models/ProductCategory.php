<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/10
 * Time: 15:00
 * 商品类
 */
namespace common\models;

use common\cache\ProductCache;
use Yii;

/**
 * shop model
 */
class ProductCategory extends BaseModel
{
    # 类缓存前缀
    const CACHE_KEY_PRE  = 'models_product_category_';
    # 缓存模块
    const CACHE_KEY_FIND = 'find_';

    protected $productCache ;

    public function init()
    {
        $this->productCache = new ProductCache();
    }

    /**
     * 获取商品分类列表
     * @return mixed
     */
    public function find($params)
    {
        //拿缓存数组
//        $data = $this->productCache->getFindCategoryCache($params);
//        if($data !== false){
//            $this->setResult($data);
//            return true;
//        }
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'pid' => isset($params['pid']) ? $params['pid'] : null,
            'level' => isset($params['level']) ? $params['level'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'isAll' => isset($params['isAll']) ? $params['isAll'] : null,
            'wx_client' => isset($params['wx_client']) ? $params['wx_client'] : null,
            'page' => 0,
            'count' => 1000,
        ];
        $this->getResult('product-category-list',$apiParams);
        if ( ! is_null($this->_data)){
            $this->productCache->setFindCategoryCache($params,$this->_data);
        }
    }

    /**
     * 添加商品分类
     * @return mixed
     */
    public function create($params)
    {
        $this->productCache->delFindCategoryCache($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'desc' => isset($params['desc']) ? $params['desc'] : null,
            'pid' => isset($params['pid']) ? $params['pid'] : null,
            'sort' => isset($params['sort']) ? $params['sort'] : null,
        ];
        $this->getResult('product-category-create',$apiParams);
    }

    /**
     * 更新商品分类
     * @return mixed
     */
    public function update($params)
    {
        $this->productCache->delFindCategoryCache($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'desc' => isset($params['desc']) ? $params['desc'] : null,
            'pid' => isset($params['pid']) ? $params['pid'] : null,
            'sort' => isset($params['sort']) ? $params['sort'] : null,
            'category_id' => isset($params['category_id']) ? $params['category_id'] : null,
        ];
        $this->getResult('product-category-update',$apiParams,false);
    }

    /**
     * 更新商品分类
     * @return mixed
     */
    public function disable($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult('product-category-disable',$apiParams);
    }

    /**
     * 更新商品分类
     * @return mixed
     */
    public function enable($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult('product-category-enable',$apiParams);
    }

}
