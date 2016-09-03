<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/10
 * Time: 15:00
 * 会员类
 */
namespace common\models;

use common\cache\BaseCache;
use Yii;

/**
 * point model
 */
class Help extends BaseModel
{

    /**
     * 获取公告列表
     */
    public function findNotice($params)
    {
        //拿接口数据
        $apiParams = [
            'to_shop_id' => isset($params['to_shop_id']) ? $params['to_shop_id'] : null,
            'to_shop_sub_id' => isset($params['to_shop_sub_id']) ? $params['to_shop_sub_id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('notice-find', $apiParams);
    }

    /**
     * 获取公告详情
     */
    public function getNotice($params)
    {
        //拿接口数据
        $apiParams = [
            'to_shop_id' => isset($params['to_shop_id']) ? $params['to_shop_id'] : null,
            'to_shop_sub_id' => isset($params['to_shop_sub_id']) ? $params['to_shop_sub_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null
        ];
        $this->getResult('notice-get', $apiParams);
    }

    /**
     * 获取帮助列表
     */
    public function findHelp($params)
    {
        //拿接口数据
        $apiParams = [
            'name' => isset($params['name']) ? $params['name'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('help-find', $apiParams);
    }

    /**
     * 获取公告详情
     */
    public function getHelp($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null
        ];
        $this->getResult('help-get', $apiParams);
    }

    /**
     * 获取反馈列表
     */
    public function findFeedback($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('feedback-find', $apiParams);
    }

    /**
     * 添加反馈
     */
    public function createFeedback($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'creator' => isset($params['creator']) ? $params['creator'] : null,
            'issue' => isset($params['issue']) ? $params['issue'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'feedback_type_id' => isset($params['feedback_type_id']) ? $params['feedback_type_id'] : null
        ];
//        BaseCache::append('test_cache', $params);
        $this->getResult('feedback-create', $apiParams);
    }

    /**
     * 获取反馈详情
     */
    public function getFeedback($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('feedback-get', $apiParams);
    }

    /**
     * 获取帮助类型列表
     * @param $params
     */
    public function findFaqType($params)
    {
        //拿接口数据
        $apiParams = [
            'name' => isset($params['name']) ? $params['name'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('help-faq-type-find', $apiParams);
    }

    /**
     * 获取反馈类型列表
     * @param $params
     */
    public function findFeedbackType($params)
    {
        //拿接口数据
        $apiParams = [
            'name' => isset($params['name']) ? $params['name'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null
        ];
        $this->getResult('feedback-type-find', $apiParams);
    }


}
