<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */

namespace common\models;

use common\cache\DocumentCache;
use Yii;
use yii\base\Model;

/**
 * Document model
 */
class Document extends BaseModel
{

//
//    protected $documentCache ;
//
//    public function init()
//    {
//        $this->documentCache = new DocumentCache();
//    }


    /**
     * 获取文件列表
     * @return mixed
     */
    public function find($params){
//        $is_search = isset($params['is_search']) && $params['is_search'] ? true : false;
//        //非查询请求  拿缓存数组
//        if(!$is_search){
//            //拿缓存数组
//            $data = $this->documentCache->getCache($params);
//            if($data !== false){
//                $this->setResult($data);
//                return true;
//            }
//        }
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'file_type' => isset($params['file_type']) ? $params['file_type'] : null,
            'category_id' => isset($params['category_id']) ? $params['category_id'] : null,
            'tag_id' => isset($params['tag_id']) ? $params['tag_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            //由于缓存列表更新机制，行数只能用固定的
            'count' => 15,
            // 只做倒序排序
            'sortStr' => ['id'=>'desc']
        ];
       $this->getResult('document-list',$apiParams);
//
//        //再从新设置缓存
//        if (!$is_search && ! is_null($this->_data)){
//            $this->documentCache->setCache($params, $this->_data);
//        }
    }

    /**
     * 创建文件
     * @return mixed
     */
    public function create($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'desc' => isset($params['desc']) ? $params['desc'] : null,
            'category_id' => isset($params['category_id']) ? $params['category_id'] : null,
            'tag_id' => isset($params['tag_id']) ? $params['tag_id'] : null,
            'file_cdn_path' => isset($params['file_cdn_path']) ? $params['file_cdn_path'] : null,
            'file_type' => isset($params['file_type']) ? $params['file_type'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null
        ];
        $this->getResult('document-create',$apiParams);
//        // 清除相关缓存
//        $this->documentCache->delCache($params);
    }

    /**
     * 修改文件
     * @return mixed
     */
    public function update($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'desc' => isset($params['desc']) ? $params['desc'] : null,
            'category_id' => isset($params['category_id']) ? $params['category_id'] : null,
            'tag_id' => isset($params['tag_id']) ? $params['tag_id'] : null,
            'file_cdn_path' => isset($params['file_cdn_path']) ? $params['file_cdn_path'] : null,
            'file_type' => isset($params['file_type']) ? $params['file_type'] : null
        ];
        $this->getResult('document-update',$apiParams);
//        // 清除相关缓存
//        $this->documentCache->delCache($params);
    }

    /**
     * 删除文档
     * @return mixed
     */
    public function delete($params){
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('document-delete',$apiParams);
    }

    /**
     * 删除文档
     * @return mixed
     */
    public function multiDelete($params){
        //拿接口数据
        $apiParams = [
            'ids' => isset($params['ids']) ? $params['ids'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('document-multi-delete',$apiParams);
    }

    /**
     * 批量修改文档的分类
     * @return mixed
     */
    public function multiUpdateDocCategory($params){
        //拿接口数据
        $apiParams = [
            'ids' => isset($params['ids']) ? $params['ids'] : null,
            'category_id' => isset($params['category_id']) ? $params['category_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('document-multi-update',$apiParams);
    }

    /**
     * 创建文档分类
     * @return mixed
     */
    public function createCategory($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
        ];
        $this->getResult('document-category-create',$apiParams);
    }

    /**
     * 修改文档分类
     * @return mixed
     */
    public function updateCategory($params){
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
        ];
        $this->getResult('document-category-update',$apiParams);
    }

    /**
     * 文档分类列表
     * @return mixed
     */
    public function findCategory($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('document-category-find',$apiParams);
    }

    /**
     * 获取文档分类
     * @return mixed
     */
    public function getCategory($params){
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('document-category-get',$apiParams);
    }

    /**
     * 删除文档分类
     * @return mixed
     */
    public function deleteCategory($params){
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('document-category-delete',$apiParams);
    }

    /**
     * 创建文件
     * @return mixed
     */
    public function userCreate($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'desc' => isset($params['desc']) ? $params['desc'] : null,
            'staff_id' => isset($params['staff_id']) ? $params['staff_id'] : null,
            'file_cdn_path' => isset($params['file_cdn_path']) ? $params['file_cdn_path'] : null,
            'file_type' => isset($params['file_type']) ? $params['file_type'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null
        ];
        $this->getResult('document-for-user-create',$apiParams);
//        // 清除相关缓存
//        $this->documentCache->delCache($params);
    }
}
