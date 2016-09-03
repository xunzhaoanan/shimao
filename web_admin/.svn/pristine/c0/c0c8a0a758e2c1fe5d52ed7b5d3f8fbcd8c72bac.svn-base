<?php
/**
 * Author: MaChenghang
 * Date: 2015/5/4
 * Time: 20:05
 * 商铺信息接口类
 * 1、店铺信息
 * 2、店铺日志
 * 3、分店列表
 */
namespace common\services\weixin;

use common\models\WxMenu;
use common\services\BaseService;
use common\vendor\wechat\WechatMenu;

class WxMenuService extends BaseService
{

    protected $wxMenuModel;
    protected $wechatMenu;
    protected $wxMaterialService;

    public function init()
    {
        $this->wxMenuModel = new WxMenu();
        $this->wxMaterialService = new WxMaterialService();
    }

    /**
     * 获取微信菜单详情
     * @return mixed
     */
    public function get($params)
    {
        $this->wxMenuModel->get($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxMenuModel->getError())){
            return $this->setError($this->wxMenuModel->getError());
        }
        $this->setResult($this->wxMenuModel->_data);
    }

    /**
     * 获取微信菜单列表
     * @return mixed
     */
    public function updateSort($params)
    {
        $this->wxMenuModel->updateSort($params);
    }

    /**
     * 获取微信菜单列表
     * @return mixed
     */
    public function find($params)
    {
        $this->wxMenuModel->find($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxMenuModel->getError())){
            return $this->setError($this->wxMenuModel->getError());
        }
        $result = [];
        foreach($this->wxMenuModel->_data['data'] as $key=>$val){
            if($val['pid'] == 0){
                $result[$val['id']]['parents'] = $val ;
            }else{
                $result[$val['pid']]['child'][] = $val ;
            }
        }
        // 有数据就格式化
        if( is_array($result) && count($result)) {
            foreach ($result as $key => $val) {
                //如果有子级菜单，就转换回复格式
                if (isset($val['child'])) {
                    foreach ($val['child'] as $childKey => $childData) {
                        switch ($childData['menu_type']) {
                            //如果回复类型是微信素材，就去格式化微信素材回复key
                            case 1 :
                                $result[$key]['child'][$childKey]['menu_url'] = $this->wxMaterialService->getMaterialByIds($result[$key]['child'][$childKey]['menu_url'], $params['shop_id']);
                                break;
                            //如果回复类型是模块，就去格式化微信素材回复key
                            case 2 :
                                $result[$key]['child'][$childKey]['menu_url'] = $this->wxMaterialService->getModelByIds($result[$key]['child'][$childKey]['menu_url'], $params['shop_id']);
                                break;
                        }
                    }
                }
                if (isset($val['parents']) && !isset($val['child'])) {
                    switch ($val['parents']['menu_type']) {
                        //如果回复类型是微信素材，就去格式化微信素材回复key
                        case 1 :
                            $result[$key]['parents']['menu_url'] = $this->wxMaterialService->getMaterialByIds($result[$key]['parents']['menu_url'], $params['shop_id']);
                            break;
                        //如果回复类型是模块，就去格式化微信素材回复key
                        case 2 :
                            $result[$key]['parents']['menu_url'] = $this->wxMaterialService->getModelByIds($result[$key]['parents']['menu_url'], $params['shop_id']);
                            break;
                    }
                }else{
                    $result[$key]['parents']['menu_url'] = '';
                }
            }
        }
        $this->setResult($result);
    }

    /**
     * 修改子级微信菜单
     * @return mixed
     */
    public function updateChild($params)
    {
        switch($params['menu_type']){
            // 如果是回复素材类型，就检验并格式化ids
            case WxMenu::MENU_TYPE_CLICK:
                $params['menu_url'] = $this->wxMaterialService->setMaterialByIds($params['menu_url']);
                if ($params['menu_url'] === false) {
                    return $this->setError('不支持的回复素材类型');
                }
                break;
            // 如果是回复活动类型，就检验并格式化ids
            case WxMenu::MENU_TYPE_MODEL:
                $params['menu_url'] = $this->wxMaterialService->setModelByIds($params['menu_url']);
                if ($params['menu_url'] === false) {
                    return $this->setError('不支持的回复模块类型');
                }
                break;
            // 如果是链接类型，就只给链接
            case WxMenu::MENU_TYPE_VIEW:
                //$params['menu_url'] = $params['menu_url']['url'];
                break;
        }
        $this->wxMenuModel->update($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxMenuModel->getError())){
            return $this->setError($this->wxMenuModel->getError());
        }
        $this->setResult($this->wxMenuModel->_data);
    }

    /**
     * 修改父级微信菜单
     * @return mixed
     */
    public function updateParents($params)
    {
        if($params['menu_url']){
            switch($params['menu_type']){
                // 如果是回复素材类型，就检验并格式化ids
                case WxMenu::MENU_TYPE_CLICK:
                    $params['menu_url'] = $this->wxMaterialService->setMaterialByIds($params['menu_url']);
                    if ($params['menu_url'] === false) {
                        return $this->setError('不支持的回复素材类型');
                    }
                    break;
                // 如果是回复活动类型，就检验并格式化ids
                case WxMenu::MENU_TYPE_MODEL:
                    $params['menu_url'] = $this->wxMaterialService->setModelByIds($params['menu_url']);
                    if ($params['menu_url'] === false) {
                        return $this->setError('不支持的回复模块类型');
                    }
                    break;
                // 如果是链接类型，就只给链接
                case WxMenu::MENU_TYPE_VIEW:
                    //$params['menu_url'] = $params['menu_url']['url'];
                    break;
            }
        }
        $this->wxMenuModel->update($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxMenuModel->getError())){
            return $this->setError($this->wxMenuModel->getError());
        }
        $this->setResult($this->wxMenuModel->_data);
    }

    /**
     * 创建父级微信菜单
     *
     * @return mixed
     */
    public function batchCreate($params)
    {
        $menu = $params['menu'];
        foreach($menu as $key=>$val){
            if(count($val['child'])){
                foreach($val['child'] as $childKey=>$childVal){
                    $menu[$key]['child'][$childKey] = $this->createChild($childVal);
                }
            }else{
                $menu[$key]['parents'] = $this->createParents($menu[$key]['parents']);
            }
        }

        $params['menu'] = $menu;
        $this->wxMenuModel->batchUpdate($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxMenuModel->getError())){
            return $this->setError($this->wxMenuModel->getError());
        }
        $this->setResult($this->wxMenuModel->_data);
    }

    /**
     * 创建子级微信菜单
     * @return mixed
     */
    private function createChild($params)
    {
        switch($params['menu_type']){
            // 如果是回复素材类型，就检验并格式化ids
            case WxMenu::MENU_TYPE_CLICK:
                $params['menu_url'] = $this->wxMaterialService->setMaterialByIds($params['menu_url']);
                if ($params['menu_url'] === false) {
                    return $this->setError('不支持的回复素材类型');
                }
                break;
            // 如果是回复活动类型，就检验并格式化ids
            case WxMenu::MENU_TYPE_MODEL:
                $params['menu_url'] = $this->wxMaterialService->setModelByIds($params['menu_url']);
                if ($params['menu_url'] === false) {
                    return $this->setError('不支持的回复模块类型');
                }
                break;
            // 如果是链接类型，就只给链接
            case WxMenu::MENU_TYPE_VIEW:
                break;
        }
        return $params;
    }

    /**
     * 创建父级微信菜单
     * @return mixed
     */
    private function createParents($params)
    {
        switch($params['menu_type']){
            // 如果是回复素材类型，就检验并格式化ids
            case WxMenu::MENU_TYPE_CLICK:
                $params['menu_url'] = $this->wxMaterialService->setMaterialByIds($params['menu_url']);
                if ($params['menu_url'] === false) {
                    return $this->setError('不支持的回复素材类型');
                }
                break;
            // 如果是回复活动类型，就检验并格式化ids
            case WxMenu::MENU_TYPE_MODEL:
                $params['menu_url'] = $this->wxMaterialService->setModelByIds($params['menu_url']);
                if ($params['menu_url'] === false) {
                    return $this->setError('不支持的回复模块类型');
                }
                break;
            // 如果是链接类型，就只给链接
            case WxMenu::MENU_TYPE_VIEW:
                break;
        }
        return $params;
    }

    /**
     * 删除微信菜单
     * @return mixed
     */
    public function delete($params)
    {
        $this->wxMenuModel->delete($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxMenuModel->getError())){
            return $this->setError($this->wxMenuModel->getError());
        }
        $this->setResult($this->wxMenuModel->_data);
    }

    /**
     * 发布微信自定义菜单
     */
    public function publish($params,$wxconfig){
        // 拿到自定义菜单数据
        $this->wxMenuModel->find($params);
        // 接收数据层处理结果
        if ( ! is_null($this->wxMenuModel->getError())){
            return $this->setError($this->wxMenuModel->getError());
        }
        if( ! is_array($this->wxMenuModel->_data['data']) || ! count($this->wxMenuModel->_data['data'])){
            return $this->setError('请添加菜单后发布');
        }
        $menuData = [];
        foreach($this->wxMenuModel->_data['data'] as $key=>$val){
            if($val['pid'] == 0){
                $menuData[$val['id']]['parents'] = $val ;
            }else{
                $menuData[$val['pid']]['child'][] = $val ;
            }
        }
        //走微信接口发布
        $this->wechatMenu = new WechatMenu($wxconfig);
        $result = $this->wechatMenu->createMenus($menuData,$wxconfig);
        // 走发布菜单接口
        if ( $result === false){
            return $this->setError('菜单发布失败，请稍后再试');
        }
        // 处理数据层返回的结果
        $this->setResult(true);
    }



}