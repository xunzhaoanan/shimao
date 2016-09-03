<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\services\weixin;

use common\models\WxShop;
use common\services\BaseService;
use Yii;
use yii\helpers\ArrayHelper;
use yii\base\Model;

class WxShopService extends BaseService
{
    public $wxShopModel ;

    public function __construct($wxconfig = false){
        $this->wxShopModel = new WxShop();
    }

    /**
     * 获取微信小店分类详情
     * @return mixed
     */
    public function getCategory($params)
    {
        $this->wxShopModel->getCategory($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxShopModel->getError())){
            return $this->setError($this->wxShopModel->getError());
        }
        $this->setResult($this->wxShopModel->_data);
    }

    /**
     * 获取微信小店分类列表
     * @return mixed
     */
    public function findCategory($params)
    {
        $this->wxShopModel->findCategory($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxShopModel->getError())){
            return $this->setError($this->wxShopModel->getError());
        }
        $this->setResult($this->wxShopModel->_data);
    }

} 