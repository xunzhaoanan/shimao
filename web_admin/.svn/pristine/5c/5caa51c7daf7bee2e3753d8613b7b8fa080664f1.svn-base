<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\services;

use common\models\Member;
use Yii;
use yii\base\Model;

class BaseService extends Model
{

    private $errorMsg = null;
    public $_data = null;
    public $_shopId;
    public $_shopSubId;
    public $_wxaccount;

    /**
     * 设置逻辑层错误信息
     */
    public function setError($params = null)
    {
        // 兼容没有 errmsg 键 的变量错误信息
        if (!is_null($params)) {
            if (is_array($params)) {
                if (!isset($params['errmsg'])) {
                    $params = [
                        'errmsg' => $params
                    ];
                }
            } else {
                $params = [
                    'errmsg' => $params
                ];
            }
        }
        $this->errorMsg = [
            'errcode' => isset($params['errcode']) ? $params['errcode'] : -2,
            'errmsg' => isset($params['errmsg']) ? $params['errmsg'] : '服务器忙，请稍后再尝试'
        ];
    }

    /**
     * 得到逻辑层错误信息
     */
    public function getError()
    {
        return $this->errorMsg;
    }

    /**
     * 设置或格式化结果集
     */
    public function setResult($data)
    {
        $this->errorMsg = null;
        $this->_data = $data;
    }

    /**
     * 得到分页参数
     * @param $form
     */
    public function getPageInfo(&$params, $defaultPage = array('page' => 0, 'count' => 20))
    {
        $page = \Yii::$app->request->post('_page');
        $count = \Yii::$app->request->post('_page_size');
        $params['page'] = isset($page) ? intval($page - 1) : $defaultPage['page'];
        $params['count'] = isset($count) ? $count : $defaultPage['count'];
        $params['count'] = $params['count'] > 100 ? 100 : $params['count'];
        if (!isset($params['sortStr'])) {
            $params['sortStr'] = ['id' => 'desc'];
        }
    }

    /**
     * 格式化参数值，得到shop_id 和 shop_sub_id
     * @param $form
     */
    public function getShopInfoParams(&$params = [])
    {
        $params['shop_id'] = $this->_shopId;
        $params['shop_sub_id'] = $this->_shopSubId;
    }


} 