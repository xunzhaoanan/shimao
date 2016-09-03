<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\services;

use Yii;

class WechatService
{

    public $_wxInfo = null;

    function __construct($account)
    {
        $this->_wxInfo = $account;
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


} 