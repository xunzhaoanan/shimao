<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\newservices;


use common\models\WxMenu;
use common\services\weixin\WxMaterialService;

class EmployessCode extends BaseService
{

    const TYPE_STAFF = 1;
    const TYPE_SHOPSUB = 2;

    protected $wxMaterialService;

    public function __construct()
    {
        parent::__construct();
        $this->wxMaterialService = new WxMaterialService();
    }

    /**
     * 获取策略信息
     */
    public function get($params)
    {
        $data = $this->getResult('employesscode-get',$params);
        $data['reply'] = $this->getReply(json_decode($data['reply'],true),$data['shop_id']);
        return $data;
    }

    /**
     * 获取策略信息
     */
    private function getReply($data,$shopId){
        foreach ($data as $key => $val) {
            switch ($val['reply_type']) {
                //如果回复类型是微信素材，就去格式化微信素材回复key
                case 1 :
                    $data[$key]['reply_params'] = $this->wxMaterialService->getMaterialByIds($val['reply_params'], $shopId);
                    break;
                //如果回复类型是模块，就去格式化微信素材回复key
                case 2 :
                    $data[$key]['reply_params'] = $this->wxMaterialService->getModelByIds($val['reply_params'], $shopId);
                    break;
            }
        }
        return $data;
    }

    /**
     * 获取策略信息
     */
    public function find($params)
    {
        return $this->getResult('employesscode-find',$params);
    }

    /**
     * 获取策略关联员工信息
     */
    public function findPolicyStaff($params)
    {
        return $this->getResult('employesscode-find-policy-staff',$params);
    }

    /**
     * 获取策略关联店铺信息
     */
    public function findPolicyStore($params)
    {
        return $this->getResult('employesscode-find-policy-shopsub',$params);
    }

    /**
     * 修改策略信息
     */
    public function update($params)
    {
        $params = $this->createReply($params);
        $params['reply'] = json_encode($params['reply']);
        return $this->getResult('employesscode-update',$params);
    }

    /**
     * 开启策略信息
     */
    public function open($params)
    {
        return $this->getResult('employesscode-open',$params);
    }

    /**
     * 关闭策略信息
     */
    public function close($params)
    {
        return $this->getResult('employesscode-close',$params);
    }

    /**
     * 删除策略信息
     */
    public function delete($params)
    {
        return $this->getResult('employesscode-delete',$params);
    }

    /**
     * 删除策略信息
     */
    public function create($params)
    {
        $params = $this->createReply($params);
        $params['reply'] = json_encode($params['reply']);
        return $this->getResult('employesscode-create',$params);
    }

    private function createReply($params){
        foreach($params['reply'] as $key=>$val){
            switch($val['reply_type']){
                // 如果是回复素材类型，就检验并格式化ids
                case WxMenu::MENU_TYPE_CLICK:
                    $result = $this->wxMaterialService->setMaterialByIds($val['reply_params']);
                    if ($result === false) {
                        return $this->setError('不支持的回复素材类型');
                    }
                    $params['reply'][$key]['reply_params'] = $result;
                    break;
                // 如果是回复活动类型，就检验并格式化ids
                case WxMenu::MENU_TYPE_MODEL:
                    $result = $this->wxMaterialService->setModelByIds($val['reply_params']);
                    if ($result === false) {
                        return $this->setError('不支持的回复模块类型');
                    }
                    $params['reply'][$key]['reply_params'] = $result;
                    break;
            }
        }
        return $params;
    }

}