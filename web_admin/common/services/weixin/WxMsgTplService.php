<?php
namespace common\services\weixin;

use common\cache\BaseCache;
use common\models\WxMsgTpl;
use common\services\BaseService;
use common\models\Shop;
use common\models\Staff;
use common\helpers\CommonLib;

class WxMsgTplService extends BaseService
{

    protected $wxMsgTpl;

    public function init()
    {
        $this->wxMsgTpl = new WxMsgTpl();
    }

    /**
     * 创建用户微信消息
     * @return mixed
     */
    public function create($params)
    {
        $this->wxMsgTpl->create($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }

    /**
     * 更新对应模板内容
     * @return mixed
     */
    public function updateMsgTpl($params)
    {
        $this->wxMsgTpl->updateMsgTpl($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }

    /**
     * 获取微信模板详情
     * @return mixed
     */
    public function getMsgTplDetail($params)
    {
        $this->wxMsgTpl->getMsgTplDetail($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }
    
    /**
     * 获取微信模板详情
     * @return mixed
     */
    public function getMsgDetail($params)
    {
        $this->wxMsgTpl->getMsgDetail($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }
    

    /**
     * 获取可用的微信模板
     * @return mixed
     */
    public function findOptionalMsgTpl($params)
    {
        $this->wxMsgTpl->findOptionalMsgTpl($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }

    /**
     * 获取已选模板列表
     * @return mixed
     */
    public function findMsgTpl($params)
    {
        $this->wxMsgTpl->findMsgTpl($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }

    /**
     * 获取可选操作员列表
     * @return mixed
     */
    public function findOptionalDefaultStaffList($params)
    {
        $this->wxMsgTpl->findOptionalDefaultStaffList($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }

    /**
     * 获取已选操作员列表
     * @return mixed
     */
    public function findDefaultStaffList($params)
    {
        $this->wxMsgTpl->findDefaultStaffList($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }

    /**
     * 添加操作员列表
     * @return mixed
     */
    public function createDefaultStaff($params)
    {
        $this->wxMsgTpl->createDefaultStaff($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }

    /**
     * 更新对应模板内容
     * @return mixed
     */
    public function updateDefaultStaff($params)
    {
        $this->wxMsgTpl->updateDefaultStaff($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }

    /**
     * 获取对应开启的模板
     * @return mixed
     */
    public function getEnableMsgTpl($params)
    {
        $this->wxMsgTpl->getEnableMsgTpl($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }
    
    public function getMessageId($params)
    {
        $this->wxMsgTpl->getMessageId($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }
    
    public function getMsgList($params)
    {
        $this->wxMsgTpl->getMsgList($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }
    
    public function getDetail($params)
    {
        $this->wxMsgTpl->getDetail($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }
    
    public function setState($params)
    {
        $this->wxMsgTpl->setState($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }
    
    public function updateMsg($params)
    {
        $this->wxMsgTpl->updateMsg($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    } 
    
    public function addShopReceive($params)
    {
        $this->wxMsgTpl->addShopReceive($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }
    
    public function addShopReceiveByUser($params)
    {
        $this->wxMsgTpl->addShopReceiveByUser($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }
    
    public function addShopReceiveByUserAndAuth($params)
    {
        $this->wxMsgTpl->addShopReceiveByUserAndAuth($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }
    
    public function setShopReceive($params)
    {
        $this->wxMsgTpl->setShopReceive($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }
    
    public function deleteShopReceive($params)
    {
        $this->wxMsgTpl->deleteShopReceive($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }
    
    public function getShopReceive($params)
    {
        $this->wxMsgTpl->getShopReceive($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMsgTpl->getError())) {
            return $this->setError($this->wxMsgTpl->getError());
        }
        $this->setResult($this->wxMsgTpl->_data);
    }
    
    public function getAllShopReceiveList($params)
    {
        $data = [];
        $params['page'] = 0;
        $params['count'] = 5000;
        if($params['type_id'] == 1)
        {
            $shop = new Shop();
            $shop->findManager($params); 
            $data = self::makeOperatorUser($shop->_data);
        }
        else if($params['type_id'] == 2)
        {
            $staff = new Staff();            
            $staff->find(['shop_id'=>$params['shop_id'],'page'=>$params['page'],'count'=>$params['count']]);   
            $data = self::makeStaffUser($staff->_data);
        }
        $this->setResult($data);
    }
    
    /**
     * 格式化操作员
     * @param array $data
     */
    public static function makeOperatorUser($data)
    {
       $res = [];
       $replace_data = [];
       if(isset($data['data']))
       {
            $res['page'] = isset($data['page'])?$data['page']:null;
            foreach ($data['data'] as $d)
            {             
                $id = $d['role_id'];
                if($id == -1 || count($d['authRole']) <1 || count($d['shopStaff']) <1)
                {
                    continue;
                }                
                if(!isset($replace_data[$id]))
                {  
                    $replace_data[$id]=['_id'=>$id,'text'=>$d['authRole']['title'],'icon'=>'','children'=>[]];
                }
                $replace_data[$id]['children'][] = ['_id'=>$d['shopStaff']['id'],'role_name'=>$d['authRole']['title'],'text'=>$d['shopStaff']['real_name'],'name'=>$d['shopStaff']['real_name'],'icon'=>'','is_bind'=>$d['shopStaff']['is_bind']];
            }
            $res['data'] = array_values($replace_data);
        }
        else 
        {
            $res['page'] = null;
            $res['data'] = null;
        }
        return $res;
    }
    
    /**
     * 格式化员工
     * @param array $data
     */
    public static function makeStaffUser($data)
    {
       $res = [];
       $replace_data = [];
       if(isset($data['data']))
       {
            $res['page'] = isset($data['page'])?$data['page']:null;
            foreach ($data['data'] as $d)
            {             
                $shop_sub_id = $d['shop_sub_id'];
                if(!isset($d['shopSub']['shopInfo']) || !isset($d['shopSub']['shopInfo']['name']))
                {
                    $shop_name = '';
                }
                else
                {
                    $shop_name = $d['shopSub']['shopInfo']['name'];
                }
                if(!isset($d['shopAgents']['agent_name']))
                {
                    $agent_name = '';
                }
                else
                {
                    $agent_name = $d['shopAgents']['agent_name'];
                }
                if(!isset($replace_data[$shop_sub_id]))
                {     
                    if(!isset($replace_data[$shop_sub_id]))
                    {
                        $replace_data[$shop_sub_id]=['_id'=>$shop_sub_id,'text'=>$shop_name,'icon'=>'','children'=>[]];
                    }
                }
                $replace_data[$shop_sub_id]['children'][] = ['_id'=>$d['id'],'text'=>$d['real_name'],'name'=>$d['real_name'],'shop_name'=>$shop_name,'agent_name'=>$agent_name,'icon'=>'','is_bind'=>$d['is_bind']];
            }
            $res['data'] = array_values($replace_data);
        }
        else 
        {
            $res['page'] = null;
            $res['data'] = null;
        }
        return $res;
    }
}