<?php
/**
 * Author: Kevin
 * Date: 2015/07/11
 * Time: 11:11
 * 模版
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * WebsiteTemplate model
 */
class WebsiteTemplate extends BaseModel
{

    /**
     * 获取模版列表
     * @return mixed
     */
    public function find()
    {
        $prefix = 'ace/css/theme/2015/';
        $themes = glob($prefix.'*');
        foreach ($themes as $k => &$v) {
            $v = substr($v, 19);
        }
        asort($themes);
        $themes = array_values($themes);
        $this->_data = $themes;
    }

    /**
     * 设置模板
     * @return mixed
     */
    /*public function set($params)
    {
        $apiParams = [
            'shopSub' => [
                'shop_id' => $params['shop_id'],
                'id' => $params['shop_sub_id'],
            ],
            'shopInfo' => [
                'theme' => $params['id'],
            ],
        ];
        $this->getResult('shop-update',$apiParams);
    }*/

    /**
     * 获取模版
     * @return mixed
     */
    public function get($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('website-template-get',$apiParams);
    }

    /**
     * 获取模版分类列表
     * @return mixed
     */
    public function cateFind($params)
    {
        $apiParams = [
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sorStr' => isset($params['sorStr']) ? $params['sorStr'] : null,
        ];
        $this->getResult('website-template-cate-list',$apiParams);
    }

    /**
     * 获取模版分类
     * @return mixed
     */
    public function cateGet($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('website-template-cate-get',$apiParams);
    }

    /**
     * 获取模版设置
     * @return mixed
     */
    public function optionsGet($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('website-template-options-get',$apiParams);
    }

    /**
     * 更新模版设置
     * @return mixed
     */
    public function optionsUpdate($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'index' => isset($params['index']) ? $params['index'] : null,
            'channel' => isset($params['channel']) ? $params['channel'] : null,
            'articles' => isset($params['articles']) ? $params['articles'] : null,
            'detail' => isset($params['detail']) ? $params['detail'] : null,
            'albums' => isset($params['albums']) ? $params['albums'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
        ];
        $this->getResult('website-template-options-update',$apiParams);
    }

}
