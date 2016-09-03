<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\services\base;

use common\cache\Session;
use common\models\Common;
use common\models\WxShop;
use common\services\BaseService;
use common\models\Shop;
use common\models\ThirdParty;

class ShopService extends BaseService
{

    protected $shopModel;

    public function init()
    {
        $this->shopModel = new Shop();
    }

    /**
     * 添加商家信息
     * @return mixed
     */
    public function create($params)
    {
        $this->shopModel->create($params);
        // 接收数据层处理结果
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * 获取微信小店分类列表
     * @return mixed
     */
    public function findWxshopCategory($params)
    {
        $wxshopModel = new WxShop();
        $wxshopModel->findCategory($params);
        // 接收数据层处理结果
        if (!is_null($wxshopModel->getError())) {
            return $this->setError($wxshopModel->getError());
        }
        $this->setResult($wxshopModel->_data);
    }

    /**
     * 获取商家信息列表
     * @return mixed
     */
    public function find($params)
    {

        $this->shopModel->find($params);
        pr('sss');
        // 接收数据层处理结果
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * 获取商家信息
     * @return mixed
     */
    public function get($params)
    {
        $this->shopModel->get($params);
        // 接收数据层处理结果
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * 修改商家信息
     * @return mixed
     */
    public function update($params)
    {
        $this->shopModel->update($params);
        // 接收数据层处理结果
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * 删除商家信息
     * @return mixed
     */
    public function del($params)
    {
        $this->shopModel->del($params);
        // 接收数据层处理结果
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * 修改微信账号配置
     * @return mixed
     */
    public function updateWxAccount($params)
    {
        $model = new Common();
        $model->updateWxConfig($params);
        // 接收数据层处理结果
        if (!is_null($model->getError())) {
            return $this->setError($model->getError());
        }
        //注意要清除session
        Session::del(Session::SESSION_KEY_WXINFO);
        $this->setResult($model->_data);
    }

    /**
     * 支付设置列表
     * @return mixed
     */
    public function paymentSettingList($params)
    {
        $this->shopModel->paymentSettingList($params);
        // 接收数据层处理结果
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->_data = $this->shopModel->_data;
        // 把所有的支付方式设置为 未开启状态
        $data = [];
        foreach ($this->shopModel->payTypeList as $key => $val) {
            $data[$key] = Shop::PAY_STATUS_CLOSE;
        }
        // 拿到支付开启状态列表
        $paySetting = isset($this->_data['pay_settings']) ? json_decode($this->_data['pay_settings'], true) : [];
        // 把商家开启过的支付方式设置为 开启状态
        if (is_array($paySetting) && count($paySetting)) {
            foreach ($paySetting as $key => $val) {
                if (array_key_exists($val, $this->shopModel->payTypeList)) {
                    $data[$val] = Shop::PAY_STATUS_OPEMN;
                }
            }
        }
        $this->setResult($data);
    }

    /**
     * 修改支付设置列表
     * @return mixed
     */
    public function updatePaymentSettingList($params)
    {
        // 处理参数
        $data = [];
        if (is_array($params['pay_settings']) && count($params['pay_settings'])) {
            foreach ($params['pay_settings'] as $key => $val) {
                if (array_key_exists($key, $this->shopModel->payTypeList) && $val == Shop::PAY_STATUS_OPEMN) {
                    $data[] = $key;
                }
            }
        }
        $modelParams = [
            'shop_id' => $params['shop_id'],
            'pay_settings' => $data
        ];
        $this->shopModel->updatePaymentSettingList($modelParams);
        // 接收数据层处理结果
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * 修改自动退款状态
     * @return mixed
     */
    public function updateRefundSetting($params)
    {
        //修改自动退款状态
        $params['auto_refund'] = $params['refundauto'] == 1 ? 1 : 2;
        $this->shopModel->update($params);
        // 接收数据层处理结果
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * 获取支付设置信息
     * @return mixed
     */
    public function getPaymentSetting($params)
    {
        $this->shopModel->getPaymentSetting($params);
        // 接收数据层处理结果
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }

    /**
     * 获取支付设置信息
     * @return mixed
     */
    public function updatePaymentSetting($params)
    {
        $this->shopModel->updatePaymentSetting($params);
        // 接收数据层处理结果
        if (!is_null($this->shopModel->getError())) {
            return $this->setError($this->shopModel->getError());
        }
        $this->setResult($this->shopModel->_data);
    }


}