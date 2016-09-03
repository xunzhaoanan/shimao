<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/25
 * Time: 20:05
 */

namespace common\models;

use common\cache\BaseCache;
use common\cache\WxMenuCache;
use Yii;
use yii\base\Model;

/**
 * WxMenu model
 */
class WxMenu extends BaseModel
{

    //显示状态
    const IS_SHOW_YES = 1;
    const IS_SHOW_NO = 2;

    //菜单类型
    const MENU_TYPE_CLICK = 1;
    const MENU_TYPE_MODEL = 2;
    const MENU_TYPE_VIEW = 3;
    public static $menuType = [self::MENU_TYPE_CLICK=>'click',self::MENU_TYPE_MODEL=>'click',self::MENU_TYPE_VIEW=>'view'];


    public function init()
    {
    }

    /**
     * 创建微信菜单
     * @return mixed
     */
    public function create($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'menuname' => isset($params['menuname']) ? $params['menuname'] : null,
            'pid' => isset($params['pid']) ? $params['pid'] : null,
            'menu_type' => isset($params['menu_type']) ? $params['menu_type'] : null,
            'menu_url' => isset($params['menu_url']) ? $params['menu_url'] : null,
            'sort' => isset($params['sort']) ? $params['sort'] : null,
            'display' => isset($params['display']) ? $params['display'] : null,
        ];
        $this->getResult('wx-menu-create',$apiParams);
    }

    /**
     * 创建微信菜单
     * @return mixed
     */
    public function updateSort($params){
        $this->getResult('wx-menu-update-sort',$params);
    }



    /**
     * 获取微信菜单列表
     * @return mixed
     */
    public function find($params){
        $this->getResult('wx-menu-list',$params);
    }

    /**
     * 修改微信菜单
     * @return mixed
     */
    public function update($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'menu_id' => isset($params['menu_id']) ? $params['menu_id'] : null,
            'menuname' => isset($params['menuname']) ? $params['menuname'] : null,
            'menu_type' => isset($params['menu_type']) ? $params['menu_type'] : null,
            'menu_url' => isset($params['menu_url']) ? $params['menu_url'] : null,
            'sort' => isset($params['sort']) ? $params['sort'] : null,
            'display' => isset($params['display']) ? $params['display'] : null,
        ];
        $this->getResult('wx-menu-update',$apiParams);
    }

    /**
     * 修改微信菜单
     * @return mixed
     */
    public function batchUpdate($params){
        $this->getResult('wx-menu-batch-update',$params);
    }

    /**
     * 删除微信菜单
     * @return mixed
     */
    public function delete($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'menu_id' => isset($params['menu_id']) ? $params['menu_id'] : null
        ];
        $this->getResult('wx-menu-del',$apiParams);
    }

}
