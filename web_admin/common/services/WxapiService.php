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

class WxapiService extends BaseService
{
	protected $wxapiModel;

	public function init()
	{

	}

    /**
     * 创建文件
     * @return mixed
     */
	public function create($params)
	{
        // 接收数据层处理结果
        $this->wxapiModel->create($params);
        if ( ! is_null($this->wxapiModel->getError())){
            return $this->setError($this->wxapiModel->getError());
        }
        $this->setResult($this->wxapiModel->_data);
	}


} 