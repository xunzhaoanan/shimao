<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\services;

use Yii;
use yii\helpers\ArrayHelper;
use yii\base\Model;
use common\models\Common;

class CommonService extends BaseService
{
	protected $commonModel;

	public function init()
	{
	    $this->commonModel = new Common();
	}

    /**
     * 获取省份列表
     * @return mixed
     */
	public function findProvince()
	{
        $this->commonModel->findProvince();
        // 接收数据层处理结果
        if ( ! is_null($this->commonModel->getError())){
            $this->setError($this->commonModel->getError());
            return false;
        }
        // 处理数据层返回的结果
        $this->setResult($this->commonModel->_data);
	}

    /**
     * 获取省的城市列表
     * @return mixed
     */
	public function findCity($params = [])
    {
        $this->commonModel->findCity($params);
        // 接收数据层处理结果
        if ( ! is_null($this->commonModel->getError())){
            $this->setError($this->commonModel->getError());
            return false;
        }
        // 处理数据层返回的结果
        $this->setResult($this->commonModel->_data);
    }

    /**
     * 获取城市的地区列表
     * @return mixed
     */
    public function findDistrict($params = [])
    {
        $this->commonModel->findDistrict($params);
        // 接收数据层处理结果
        if ( ! is_null($this->commonModel->getError())){
            $this->setError($this->commonModel->getError());
            return false;
        }
        // 处理数据层返回的结果
        $this->setResult($this->commonModel->_data);
    }

    /**
     * 获取商圈列表
     * @return mixed
     */
    public function findCircle($params = [])
    {
        $this->commonModel->findCircle($params);
        // 接收数据层处理结果
        if ( ! is_null($this->commonModel->getError())){
            $this->setError($this->commonModel->getError());
            return false;
        }
        // 处理数据层返回的结果
        $this->setResult($this->commonModel->_data);
    }

    /**
     * 获取所有省市区列表
     * @return mixed
     */
    public function findArea()
    {
        $this->commonModel->findArea();
        // 接收数据层处理结果
        if ( ! is_null($this->commonModel->getError())){
            $this->setError($this->commonModel->getError());
            return false;
        }
        // 处理数据层返回的结果
        $this->setResult($this->commonModel->_data);
    }

    /**
     * 根据id获取省市区名称
     * 参数：数组或数字
     * @return mixed
     */
    public function getAreaName($params = [])
    {
        $this->commonModel->getAreaName($params);
        // 接收数据层处理结果
        if ( ! is_null($this->commonModel->getError())){
            $this->setError($this->commonModel->getError());
            return false;
        }
        // 处理数据层返回的结果
        $this->setResult($this->commonModel->_data);
    }


    /**
     * 获取微信配置
     * @return array
     */
    public function getThirdPartyInfo($params = [])
    {
        $this->commonModel->getThirdPartyInfo($params);
        // 接收数据层处理结果
        if ( ! is_null($this->commonModel->getError())){
            $this->setError($this->commonModel->getError());
            return false;
        }
        // 处理数据层返回的结果
        $this->setResult($this->commonModel->_data);
    }

    /**
     * 获取微信配置
     * @return array
     */
    public function getThirdPartyInfoByAccount($params = [])
    {
        $this->commonModel->getThirdPartyInfoByAccount($params);
        // 接收数据层处理结果
        if ( ! is_null($this->commonModel->getError())){
            $this->setError($this->commonModel->getError());
            return false;
        }
        // 处理数据层返回的结果
        $this->setResult($this->commonModel->_data);
    }

} 