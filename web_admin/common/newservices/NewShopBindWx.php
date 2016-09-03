<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\newservices;

use common\cache\CommonCache;
use common\helpers\CommonFunctionHelper;
use Yii;

class NewShopBindWx extends BaseService
{

    protected $commonCache;
    public function __construct()
    {
        parent::__construct();
        $this->commonCache = new CommonCache();
    }


    /**
     * 根据商家id获取商家绑定微信配置
     */
    public function getByShopId($params)
    {
        if( ! CommonFunctionHelper::arrayKeyExists($params,'shop_id')){
            $this->setError('缺失必要参数');
        }
        $params['platform_type'] = NewShopPlatform::TYPE_WECHAT;
        return $this->getResult('third-party-get',$params);
    }

    /**
     * 根据微信号获取商家绑定微信配置
     */
    public function getByShopAccount($params)
    {
        $data = $this->commonCache->getThirdPartyInfoByAccount($params);
        if($data !== false){
            return $data;
        }
        //拿接口数据
        $apiParams = [
            'account' => isset($params['account']) ? $params['account'] : null,
            'platform_type' => isset($params['platform_type']) ? $params['platform_type'] : null,
        ];
        $data = $this->getResult('third-party-get-by-account',$apiParams);
        $this->commonCache->setThirdPartyInfoByAccount($params, $data);
        return $data;
    }

    
} 