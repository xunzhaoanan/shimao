<?php
/**
 * Author: LiuPing
 * Date: 2015/08/15
 * Time: 14:19
 */

namespace common\models;

use common\cache\BaseCache;
use Yii;
use yii\base\Model;

/**
 * role model
 */
class Role extends BaseModel
{
    // 类缓存前缀
    const CACHE_KEY_PRE = 'models_role_';

    //所属系统  1:admin后台
    const SYSTEM_ADMIN = 1;
    //所属系统  2:店铺后台
    const SYSTEM_SHOP = 2;
    //所属系统  3：代理商后台
    const SYSTEM_AGENT = 3;
    //是否为初始化默认角色 ：是
    const IS_DEFAULT_TRUE = 1;
    //是否为初始化默认角色 ：否
    const IS_DEFAULT_FALSE = 2;

    /**
     * 添加角色信息
     * @return mixed
     */
    public function create($params)
    {
        //拿接口数据
        $apiParams = [
            'title' => isset($params['title']) ? $params['title'] : null,
            'system' => isset($params['system']) ? $params['system'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('role-create', $apiParams);
    }

    /**
     * 添加角色信息
     * @return mixed
     */
    public function update($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'system' => isset($params['system']) ? $params['system'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('role-update', $apiParams);
    }

    /**
     * 获取角色信息列表
     * @return mixed
     */
    public function find($params)
    {
        //拿接口数据
        $apiParams = [
            'system' => isset($params['system']) ? $params['system'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'doFilter' => isset($params['doFilter']) ? $params['doFilter'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
            'shop_type' => isset($params['shop_type']) ? $params['shop_type'] : null
        ];
        $this->getResult('role-find', $apiParams);
    }

    /**
     * 获取角色信息
     * @return mixed
     */
    public function get($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null
        ];
        $this->getResult('role-get', $apiParams);
    }

    /**
     * 删除角色信息
     * @return mixed
     */
    public function delete($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('role-del', $apiParams);
    }

    /**
     * 获取角色权限菜单
     * @return mixed
     */
    public function findRoleMenu($params)
    {
        //拿接口数据
        $apiParams = [
            'role_id' => isset($params['role_id']) ? $params['role_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('role-find-role-menu', $apiParams);
    }

    /**
     * 获取角色权限菜单
     * @return mixed
     */
    public function findMenu($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'system' => isset($params['system']) ? $params['system'] : null,
            'sortStr' => ['sort'=>'asc'],
        ];
        $this->getResult('role-find-menu', $apiParams);
    }

    /**
     * 获取角色功能权限
     * @return mixed
     */
    public function findRoleFunction($params)
    {
        $cahce = BaseCache::get('_permission'.$params['role_id']);
        if($cahce){
            return $this->setResult($cahce);
        }
        //拿接口数据
        $apiParams = [
            'role_id' => isset($params['role_id']) ? $params['role_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null
        ];
        $this->getResult('find-role-function', $apiParams);
        BaseCache::set('_permission'.$params['role_id'],$this->_data,3600);
    }

    /**
     * 获取权限权限列表以及权限列表
     * @return mixed
     */
    public function findFunctionMenuWithFunction($params)
    {
        //拿接口数据
        $apiParams = [
            'system' => isset($params['system']) ? $params['system'] : null,
            'pid' => isset($params['pid']) ? $params['pid'] : null,
            'level' => isset($params['level']) ? $params['level'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('role-find-function-menu-with-function', $apiParams);
    }

    /**
     * 分配角色功能权限
     * @return mixed
     */
    public function saveRoleFunction($params)
    {
        BaseCache::del('_permission'.$params['auth_role_id']);
        //拿接口数据
        $apiParams = [
            'auth_role_id' => isset($params['auth_role_id']) ? $params['auth_role_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'function_menu_ids' => isset($params['ids']) ? $params['ids'] : null,
        ];
        $this->getResult('role-save-role-function', $apiParams);
    }

}
