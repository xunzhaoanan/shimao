<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/10
 * Time: 15:00
 * 商品类
 */
namespace common\models;

use common\cache\ShopMenuCache;
use Yii;

/**
 * shop model
 */
class Custompage extends BaseModel
{

    protected $shopMenuCache;

    public function init(){
        $this->shopMenuCache = new ShopMenuCache();
    }

    /**
     * 新增页面
     * @return mixed
     */
    public function create($apiParams)
    {
        $apiParams['items'] = json_encode($apiParams['items']);
        $this->getResult('custompage-create',$apiParams);
        $this->_data['items'] = json_decode($apiParams['items'],true);
    }

    /**
     * 获取页面列表
     * @return mixed
     */
    public function find($apiParams)
    {
        $this->getResult('custompage-find',$apiParams);
        if(is_array($this->_data['data']) && count($this->_data['data'])){
            foreach($this->_data['data'] as $key=>$val){
                $this->_data['data'][$key]['items'] = json_decode($val['items'],true);
            }
        }
    }

    /**
     * 修改页面
     * @return mixed
     */
    public function update($apiParams)
    {
        $apiParams['items'] = json_encode($apiParams['items']);
        $this->getResult('custompage-update',$apiParams);
        $this->_data['items'] = json_decode($apiParams['items'],true);
    }

    /**
     * 获取页面
     * @return mixed
     */
    public function get($apiParams)
    {
        $this->getResult('custompage-get',$apiParams);
    }

    /**
     * 删除页面
     * @return mixed
     */
    public function delete($apiParams)
    {
        $this->getResult('custompage-delete',$apiParams);
    }

    /**
     * 复制页面
     * @return mixed
     */
    public function copy($apiParams)
    {
        $this->getResult('custompage-copy',$apiParams);
    }

    /**
     * 禁用页面
     * @return mixed
     */
    public function close($apiParams)
    {
        $this->getResult('custompage-close',$apiParams);
    }

    /**
     * 启用页面
     * @return mixed
     */
    public function open($apiParams)
    {
        $this->getResult('custompage-open',$apiParams);
    }

    /**
     * 设置为官网主页
     * @return mixed
     */
    public function setHome($apiParams)
    {
        $this->getResult('custompage-sethome',$apiParams);
    }

    /**
     * 设置为店铺主页
     * @return mixed
     */
    public function setMall($apiParams)
    {
        $this->getResult('custompage-setmall',$apiParams);
    }

    /**
     * 获取导航模板
     * @return mixed
     */
    public function getMenu($apiParams)
    {
        if($this->shopMenuCache->getCache($apiParams)){
            return $this->setResult($this->shopMenuCache->getCache($apiParams));
        }
        $this->getResult('custompage-getmenu',$apiParams);
        $this->shopMenuCache->setCache($apiParams,$this->_data);
    }

    /**
     * 设置为导航模板
     * @return mixed
     */
    public function setMenu($apiParams)
    {
        $this->getResult('custompage-setmenu',$apiParams);
        $this->shopMenuCache->setCache($apiParams,$this->_data);
    }

}
