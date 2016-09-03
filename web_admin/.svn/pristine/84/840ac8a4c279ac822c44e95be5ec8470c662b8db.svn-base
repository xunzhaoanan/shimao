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
use yii\base\Model;

/**
 * shop model
 */
class Product extends BaseModel
{

    const STATUS_ONSALE = 1;
    const STATUS_OFFSALE = 2;

    const RECOMMEND_TURE = 1;
    const RECOMMEND_FALSE = 2;

    protected $productCache ;

    public function init()
    {
        $this->productCache = new ProductCache();
    }

    /**
     * 获取商品列表
     *
     * @return mixed
     */
    public function find($params, $is_search = false)
    {
        $params['count'] = 10;
        //非查询请求  拿缓存数组
        if(!$is_search){
            if(isset($params['is_recommend']) && $params['is_recommend'] == self::RECOMMEND_TURE){
                //推荐商品列表
                $data = $this->productCache->getFindCache($params);
            }else{
                //上架商品列表
                $data = $this->productCache->getFindCache($params);
            }
            if($data !== false){
                $this->setResult($data);
                return true;
            }
        }
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'sale_scope' => isset($params['sale_scope']) ? $params['sale_scope'] : null,
            'product_no' => isset($params['product_no']) ? $params['product_no'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'product_category_id' => isset($params['product_category_id']) ? $params['product_category_id'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'ids' => isset($params['ids']) ? $params['ids'] : null,
            'is_recommend' => isset($params['is_recommend']) ? $params['is_recommend'] : null,
            'fx_product_filter' => isset($params['fx_product_filter']) ? true : null,
            'reserves' => isset($params['reserves']) ? $params['reserves'] : null,
            'postage_fee_type' => isset($params['postage_fee_type']) ? $params['postage_fee_type'] : null,
            //'is_member_discount' => isset($params['is_member_discount']) ? $params['is_member_discount'] : null
        ];
        $this->getResult('product-list',$apiParams);
        //再从新设置缓存
        if ( ! $is_search && ! is_null($this->_data)){
            if(isset($params['is_recommend']) && $params['is_recommend'] == self::RECOMMEND_TURE){
                //推荐商品列表
                $this->productCache->setFindRecommendCache($params,$this->_data);
            }else{
                //上架商品列表
                $this->productCache->setFindCache($params,$this->_data);
            }
        }
    }

    /**
     * 获取会员商品列表
     *
     * @return mixed
     */
    public function findOnlyMember($params, $is_search = false)
    {
        $params['count'] = 10;
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'sale_scope' => isset($params['sale_scope']) ? $params['sale_scope'] : null,
            'product_no' => isset($params['product_no']) ? $params['product_no'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'product_category_id' => isset($params['product_category_id']) ? $params['product_category_id'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'ids' => isset($params['ids']) ? $params['ids'] : null,
            'is_recommend' => isset($params['is_recommend']) ? $params['is_recommend'] : null,
            'fx_product_filter' => isset($params['fx_product_filter']) ? true : null,
            'reserves' => isset($params['reserves']) ? $params['reserves'] : null,
            'postage_fee_type' => isset($params['postage_fee_type']) ? $params['postage_fee_type'] : null,
            //'is_member_discount' => isset($params['is_member_discount']) ? $params['is_member_discount'] : null
        ];
        $this->getResult('product/find-member-product-with-other-info',$apiParams);
    }
    /**
     * 获取商品详情
     * @return mixed
     */
    public function get($params)
    {
        $this->_data = null;
        //拿缓存数组
	    if( ! isset($params['getDb'])){
            $data = $this->productCache->getCache($params);
            if($data !== false){
                $this->setResult($data);
                return true;
            }
        }
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'product_id' => isset($params['product_id']) ? $params['product_id'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
        ];
        $this->getResult('product-get',$apiParams);
        //再从新设置缓存
        if ( ! is_null($this->_data)){
            $result = $this->_get($this->_data);
            $this->setResult($result);
	        if( ! isset($params['getDb'])){
	    	    $this->productCache->setCache($params, $result);
            }
        }
    }

    /**
     * 格式化商品详情
     * 内部调用
     * @return mixed
     */
    private function _get($productInfo){
        $productInfo['product']['show_price'] = self::amountToYuan($productInfo['product']['show_price']);
        foreach($productInfo['product']['productSkus'] as $key=>$val){
            $productInfo['product']['productSkus'][$key]['market_price'] = self::amountToYuan($productInfo['product']['productSkus'][$key]['market_price'], true);
            $productInfo['product']['productSkus'][$key]['cost_price'] = self::amountToYuan($productInfo['product']['productSkus'][$key]['cost_price'], true);
            $productInfo['product']['productSkus'][$key]['retail_price'] = self::amountToYuan($productInfo['product']['productSkus'][$key]['retail_price'], true);
            //规格信息
            $i = 0;
            foreach($val['kinds'] as $kind){
                $productInfo['kindGroup'][$kind['id']]['name'] = $kind['name'];
                $productInfo['kindGroup'][$kind['id']]['sort'] = $i;
                $i++;
	        }

            $skuKey = '';
            foreach($val['kindValues'] as $kindValue){
                $skuKey .= $kindValue['id'].'_';
                $productInfo['kindGroup'][$kindValue['product_kind_id']]['value'][$kindValue['id']] = [
                    'id' => $kindValue['id'],
                    'name' => $kindValue['name'],
                ];
            }
            //把下架的sku商品库存设置成0
            $val['real_reserves'] = $val['reserves'];
            if($val['status'] == self::STATUS_OFFSALE){
                $val['reserves'] = 0;
            }
            //转化金额为元
            $val['market_price'] = self::amountToYuan($val['market_price'], true);
            $val['cost_price'] = self::amountToYuan($val['cost_price'], true);
            $val['retail_price'] = self::amountToYuan($val['retail_price'], true);

            $productInfo['skuGroup'][$skuKey] = $val;
            unset($productInfo['skuGroup'][$skuKey]['kinds']);
            unset($productInfo['skuGroup'][$skuKey]['kindValues']);
        }

        $kind = [];
        if (isset($productInfo['kindGroup'])) {
            foreach ($productInfo['kindGroup'] as $key => $val) {
                if (!empty($val['value'])) {
                    $kind[] = array_keys($val['value']);
                }
            }
        }
        if (isset($productInfo['skuGroup'])) {
            foreach ($productInfo['skuGroup'] as $key => $val) {
                $explodeData = explode('_', $key);
                unset($explodeData[count($explodeData) - 1]);
                foreach ($explodeData as $explodeKey => $explodeVal) {
                    if (!in_array($explodeVal, $kind[$explodeKey])) {
                        $newKey = '';
                        foreach ($kind as $kindVal) {
                            foreach ($explodeData as $kk => $vv) {
                                if (in_array($vv, $kindVal)) {
                                    $newKey .= $vv . '_';
                                    break;
                                }
                            }
                        }
                        $productInfo['skuGroup'][$newKey] = $val;
                        unset($productInfo['skuGroup'][$key]);
                    }
                }
            }
        }
        return $productInfo;
    }


    /**
     * 删除商品
     * @return mixed
     */
    public function del($params)
    {
        $this->productCache->delCache($params);
        $this->productCache->delFindCache($params);
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'ids' => isset($params['ids']) ? $params['ids'] : null
        ];
        $this->getResult('product-del',$apiParams);
    }

    /**
     * 批量修改商品分类
     * @return mixed
     */
    public function updateCategory($params)
    {
        $this->productCache->delCache($params);
        $this->productCache->delFindCache($params);
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'ids' => isset($params['ids']) ? $params['ids'] : null,
            'product_category_id' => isset($params['product_category_id']) ? $params['product_category_id'] : null
        ];
        $this->getResult('product-update-category',$apiParams);
    }

    /**
     * 商品下架
     * @return mixed
     */
    public function offSale($params)
    {
        $this->productCache->delCache($params);
        $this->productCache->delFindCache($params);
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'ids' => isset($params['ids']) ? $params['ids'] : null
        ];
        $this->getResult('product-off-sale',$apiParams);
    }

    /**
     * 商品上架
     * @return mixed
     */
    public function onSale($params)
    {
        $this->productCache->delCache($params);
        $this->productCache->delFindCache($params);
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'ids' => isset($params['ids']) ? $params['ids'] : null
        ];
        $this->getResult('product-on-sale',$apiParams);
    }

    /**
     * 推荐商品
     * @return mixed
     */
    public function recommend($params)
    {
        //缓存的商品id是 product_id，转换下
        $params['product_id'] = isset($params['id']) ? $params['id'] : null;
        $this->productCache->delFindRecommendCache($params);
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null
        ];
        $this->getResult('product-recommend',$apiParams);
    }

    /**
     * 不推荐上架
     * @return mixed
     */
    public function unrecommend($params)
    {
        //缓存的商品id是 product_id，转换下
        $params['product_id'] = isset($params['id']) ? $params['id'] : null;
        $this->productCache->delFindRecommendCache($params);
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null
        ];
        $this->getResult('product-un-recommend',$apiParams);
    }

    /**
     * 商品添加
     * @return mixed
     */
    public function create($params)
    {
        //缓存的商品id是 product_id，转换下
        $params['shop_id'] = isset($params['product']['shop_id']) ? $params['product']['shop_id'] : null;
        $this->productCache->delFindCache($params);
        // 注意，需要把价格都单位转成分
        $apiParams = [
            'product' => [
                'product_category_id' => isset($params['product']['product_category_id']) ? $params['product']['product_category_id'] : null,
                'product_category_path' => isset($params['product']['product_category_path']) ? $params['product']['product_category_path'] : null,
                'product_kind_ids' => isset($params['product']['product_kind_ids']) ? $params['product']['product_kind_ids'] : null,
                'name' => isset($params['product']['name']) ? $params['product']['name'] : null,
                'subtitle' => isset($params['product']['subtitle']) ? $params['product']['subtitle'] : null,
                'keyword' => isset($params['product']['keyword']) ? $params['product']['keyword'] : null,
                'product_type' => isset($params['product']['product_type']) ? $params['product']['product_type'] : null,
                'sale_scope' => isset($params['product']['sale_scope']) ? $params['product']['sale_scope'] : null,
                'product_no' => isset($params['product']['product_no']) ? $params['product']['product_no'] : null,
                'show_price' => isset($params['product']['show_price']) ? self::amountToFen($params['product']['show_price']) : null,
                'prod_weight' => isset($params['product']['prod_weight']) ? $params['product']['prod_weight'] : null,
                'shop_id' => isset($params['product']['shop_id']) ? $params['product']['shop_id'] : null,
                'shop_sub_id' => isset($params['product']['shop_sub_id']) ? $params['product']['shop_sub_id'] : null,
                'hits' => isset($params['product']['hits']) ? $params['product']['hits'] : null,
                'sales' => isset($params['product']['sales']) ? $params['product']['sales'] : null,
                'status' => isset($params['product']['status']) ? $params['product']['status'] : null,
                'postage_fee_type' => isset($params['product']['postage_fee_type']) ? $params['product']['postage_fee_type'] : null,
                'quota' => isset($params['product']['quota']) ? $params['product']['quota'] : null,
                'sort' => isset($params['product']['sort']) ? $params['product']['sort'] : null,
                'is_pre_sale' => isset($params['product']['is_pre_sale']) ? $params['product']['is_pre_sale'] : null,
                'pre_sale_id' => isset($params['product']['pre_sale_id']) ? $params['product']['pre_sale_id'] : null,
                'show_sale_num' => isset($params['product']['show_sale_num']) ? $params['product']['show_sale_num'] : null,
                'covers_id' => isset($params['product']['covers_id']) ? $params['product']['covers_id'] : null,
            ],
            'productInfo' => [
                'description' => isset($params['productInfo']['description']) ? $params['productInfo']['description'] : null,
                'detail_pic' => isset($params['productInfo']['detail_pic']) ? $params['productInfo']['detail_pic'] : null,
                'detail' => isset($params['productInfo']['detail']) ? $params['productInfo']['detail'] : null,
            ],
            'skus' => $this->formatSku($params['skus']) ,
            'shareMessage' => [
                'title' => isset($params['shareMessage']['title']) ? $params['shareMessage']['title'] : null,
                'desc' => isset($params['shareMessage']['desc']) ? $params['shareMessage']['desc'] : null,
                'pic_id' => isset($params['shareMessage']['pic_id']) ? $params['shareMessage']['pic_id'] : null,
            ]
        ];
        $this->getResult('product-create',$apiParams,false);
    }

    /**
     * 商品更新
     * @return mixed
     */
    public function update($params)
    {
        //缓存的商品id是 product_id，转换下
        $params['product_id'] = isset($params['product']['id']) ? $params['product']['id'] : null;
        $params['shop_id'] = isset($params['product']['shop_id']) ? $params['product']['shop_id'] : null;
        $this->productCache->delCache($params);
        $this->productCache->delFindCache($params);
        $apiParams = [
            'product' => [
                'id' => isset($params['product']['id']) ? $params['product']['id'] : null,
                'product_category_id' => isset($params['product']['product_category_id']) ? $params['product']['product_category_id'] : null,
                'product_category_path' => isset($params['product']['product_category_path']) ? $params['product']['product_category_path'] : null,
                'product_kind_ids' => isset($params['product']['product_kind_ids']) ? $params['product']['product_kind_ids'] : null,
                'name' => isset($params['product']['name']) ? $params['product']['name'] : null,
                'subtitle' => isset($params['product']['subtitle']) ? $params['product']['subtitle'] : null,
                'keyword' => isset($params['product']['keyword']) ? $params['product']['keyword'] : null,
                'product_type' => isset($params['product']['product_type']) ? $params['product']['product_type'] : null,
                'sale_scope' => isset($params['product']['sale_scope']) ? $params['product']['sale_scope'] : null,
                'product_no' => isset($params['product']['product_no']) ? $params['product']['product_no'] : null,
                'show_price' => isset($params['product']['show_price']) ? self::amountToFen($params['product']['show_price']) : null,
                'prod_weight' => isset($params['product']['prod_weight']) ? $params['product']['prod_weight'] : null,
                'shop_id' => isset($params['product']['shop_id']) ? $params['product']['shop_id'] : null,
                'shop_sub_id' => isset($params['product']['shop_sub_id']) ? $params['product']['shop_sub_id'] : null,
                'hits' => isset($params['product']['hits']) ? $params['product']['hits'] : null,
                'sales' => isset($params['product']['sales']) ? $params['product']['sales'] : null,
                'status' => isset($params['product']['status']) ? $params['product']['status'] : null,
                'postage_fee_type' => isset($params['product']['postage_fee_type']) ? $params['product']['postage_fee_type'] : null,
                'quota' => isset($params['product']['quota']) ? $params['product']['quota'] : null,
                'sort' => isset($params['product']['sort']) ? $params['product']['sort'] : null,
                'is_pre_sale' => isset($params['product']['is_pre_sale']) ? $params['product']['is_pre_sale'] : null,
                'pre_sale_id' => isset($params['product']['pre_sale_id']) ? $params['product']['pre_sale_id'] : null,
                'show_sale_num' => isset($params['product']['show_sale_num']) ? $params['product']['show_sale_num'] : null,
                'covers_id' => isset($params['product']['covers_id']) ? $params['product']['covers_id'] : null,
            ],
            'productInfo' => [
                'description' => isset($params['productInfo']['description']) ? $params['productInfo']['description'] : null,
                'detail_pic' => isset($params['productInfo']['detail_pic']) ? $params['productInfo']['detail_pic'] : null,
                'detail' => isset($params['productInfo']['detail']) ? $params['productInfo']['detail'] : null,
            ],
            'skus' => $this->formatSku($params['skus']) ,
            'shareMessage' => [
                'title' => isset($params['shareMessage']['title']) ? $params['shareMessage']['title'] : null,
                'desc' => isset($params['shareMessage']['desc']) ? $params['shareMessage']['desc'] : null,
                'pic_id' => isset($params['shareMessage']['pic_id']) ? $params['shareMessage']['pic_id'] : null,
            ]
        ];
        $this->getResult('product-update',$apiParams,false);
    }

    /**
     * 添加商品评论
     * @return mixed
     */
    public function createComment($params)
    {
        $this->productCache->delComment($params);
        $this->productCache->delCommentAverage($params);
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'content' => isset($params['content']) ? $params['content'] : null,
            'product_id' => isset($params['product_id']) ? $params['product_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'star' => isset($params['star']) ? $params['star'] : null,
            'ip' => isset($params['ip']) ? $params['ip'] : null,
            'reply' => isset($params['reply']) ? $params['reply'] : null,
            'reply_uid' => isset($params['reply_uid']) ? $params['reply_uid'] : null,
            'order_detail_id' => isset($params['order_detail_id']) ? $params['order_detail_id'] : null
        ];
        $this->getResult('product-comment-create',$apiParams);
    }

    /**
     * 回复商品评论
     * @return mixed
     */
    public function replyComment($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'content' => isset($params['content']) ? $params['content'] : null,
            'product_id' => isset($params['product_id']) ? $params['product_id'] : null,
            'uid' => isset($params['uid']) ? $params['uid'] : null,
            'star' => isset($params['star']) ? $params['star'] : null,
            'ip' => isset($params['ip']) ? $params['ip'] : null,
            'reply' => isset($params['reply']) ? $params['reply'] : null,
            'reply_uid' => isset($params['reply_uid']) ? $params['reply_uid'] : null,
            'order_detail_id' => isset($params['order_detail_id']) ? $params['order_detail_id'] : null
        ];
        $this->getResult('product-comment-create',$apiParams);
    }

    /**
     * 获取商品评价评价星
     * @return mixed
     */
    public function getAveragePoint($params)
    {
        $data = $this->productCache->getCommentAverage($params);
        if($data !== false){
            $this->setResult($data);
            return true;
        }
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'product_id' => isset($params['product_id']) ? $params['product_id'] : null
        ];
        $this->getResult('product-average-comment-get',$apiParams);
        //再从新设置缓存
        if ( ! is_null($this->_data)){
            $this->productCache->setCommentAverage($params,$this->_data);
        }
    }


    /**
     * 获取商品评论列表
     * @return mixed
     */
    public function findComment($params)
    {
        //由于缓存列表更新机制，行数只能用固定的
        // $params['count'] = 20;
        // if(isset($params['product_id']) && $params['product_id']){
        //     $data = $this->productCache->getComment($params);
        //     if($data !== false){
        //         $this->setResult($data);
        //         return true;
        //     }
        // }
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'product_id' => isset($params['product_id']) ? $params['product_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            's_content' => isset($params['s_content']) ? $params['s_content'] : null,
            's_product_name' => isset($params['s_product_name']) ? $params['s_product_name'] : null,
            'comment_type' => isset($params['comment_type']) ? $params['comment_type'] : null
        ];
        $this->getResult('product-comment-list',$apiParams);
        //再从新设置缓存
        if( ! is_null($this->_data)){
            $this->productCache->setComment($params, $this->_data);
        }
    }

    /**
     * 删除商品评论
     * @return mixed
     */
    public function delComment($params)
    {
        $this->productCache->delComment($params);
        $this->productCache->delCommentAverage($params);
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'product_id' => isset($params['product_id']) ? $params['product_id'] : null,
            'comment_id' => isset($params['comment_id']) ? $params['comment_id'] : null
        ];
        $this->getResult('product-comment-del',$apiParams);
    }

    /**
     * 获取上架中商品数量
     * @return mixed
     */
    public function getOnSaleCount($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $apiData = $this->postCurl('product-on-sale-count',$apiParams);
        return $apiData;
    }

    /**
     * 获取下架中商品数量
     * @return mixed
     */
    public function getOffSaleCount($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $apiData = $this->postCurl('product-off-sale-count',$apiParams);
        return $apiData;
    }

    /**
     * 获取商品总数量
     * @return mixed
     */
    public function getAllCount($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $apiData = $this->postCurl('product-all-count',$apiParams);
        return $apiData;
    }


    private function formatSku($sku){
        foreach($sku as $key=>$params) {
            $sku[$key] = [
                'id' => isset($params['id']) ? $params['id'] : null,
                'sku_no' => isset($params['sku_no']) ? $params['sku_no'] : null,
                'name' => isset($params['name']) ? $params['name'] : null,
                'reserves' => isset($params['reserves']) ? $params['reserves'] : null,
                'freez_reserve' => isset($params['freez_reserve']) ? $params['freez_reserve'] : null,
                'market_price' => isset($params['market_price']) ? self::amountToFen($params['market_price']) : null,
                'cost_price' => isset($params['cost_price']) ? self::amountToFen($params['cost_price']) : null,
                'retail_price' => isset($params['retail_price']) ? self::amountToFen($params['retail_price']) : null,
                'status' => isset($params['status']) ? $params['status'] : null,
                'barcode' => isset($params['barcode']) ? $params['barcode'] : null,
                'barcode_pic' => isset($params['barcode_pic']) ? $params['barcode_pic'] : null,
                'kind_ids' => isset($params['kind_ids']) ? $params['kind_ids'] : null,
                'kind_value_ids' => isset($params['kind_value_ids']) ? $params['kind_value_ids'] : null
            ];
        }
        return $sku;
    }

    /**
     * 商品评论
     * @return mixed
     */
    public function commentWithoutUser($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'product_id' => isset($params['product_id']) ? $params['product_id'] : null,
            'star' => isset($params['star']) ? $params['star'] : null,
            'content' => isset($params['content']) ? $params['content'] : null,
            'avatar' => isset($params['avatar']) ? $params['avatar'] : null,
            'created' => isset($params['created']) ? $params['created'] : null
        ];
        $this->getResult('product-comment-create-without-user',$apiParams);
    }
}
