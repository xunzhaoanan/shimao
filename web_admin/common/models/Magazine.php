<?php
/**
 * Author: MaChenghang
 * Date: 2015/6/13
 * Time: 14:19
 */

namespace common\models;

use common\cache\MagazineCache;
use Yii;
use yii\base\Model;

/**
 * Common model
 */
class Magazine extends BaseModel
{

    const TYPE_SHOP = 1;
    const TYPE_SYSTEM = 2;
    const FLAG_YES = 1;
    const FLAG_NO = 2;
    public $createDefaultParams = [
        'face_id' => '856',
        'share' => [
            'doc_id' => '857',
            'desc' => '微杂志，企业移动营销利器，H5神器啊！'
        ]
    ];

    protected $magazineCache;

    public function init()
    {
        $this->magazineCache = new MagazineCache();
    }

    /**
     * 获取杂志信息
     * @return mixed
     */
    public function get($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null
        ];
        $this->getResult('magazine-get', $apiParams);
    }

    /**
     * 创建杂志信息
     * @return mixed
     */
    public function create($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'category_id' => isset($params['category_id']) ? $params['category_id'] : null,
            'face_document_id' => isset($params['face_document_id']) ? $params['face_document_id'] : null,
            'music_document_id' => isset($params['music_document_id']) ? $params['music_document_id'] : null,
            'version' => isset($params['version']) ? $params['version'] : null,
            'magazineInfo' => $this->magazineInfo($params['magazineInfo']),
            'shareMessage' => [
                'title' => isset($params['shareMessage']['title']) ? $params['shareMessage']['title'] : null,
                'desc' => isset($params['shareMessage']['desc']) ? $params['shareMessage']['desc'] : null,
                'pic_id' => isset($params['shareMessage']['documentLib']['id']) ? $params['shareMessage']['documentLib']['id'] : null,
            ],
        ];
        if (is_null($apiParams['shareMessage']['desc'])) {
            $apiParams['shareMessage'] = null;
        }
        $this->getResult('magazine-create', $apiParams);
    }

    /**
     * 创建杂志信息
     * @return mixed
     */
    public function createByTemplate($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'template_id' => isset($params['template_id']) ? $params['template_id'] : null,
        ];
        $this->getResult('magazine-create-by-template', $apiParams);
    }

    /**
     * 杂志页面信息转换
     * @return mixed
     */
    private function magazineInfo($sku)
    {
        if (is_array($sku) && count($sku)) {
            foreach ($sku as $key => $params) {
                $sku[$key] = [
                    'id' => isset($params['id']) ? $params['id'] : null,
                    'content' => isset($params['content']) ? $params['content'] : null,
                    'page' => isset($params['page']) ? $params['page'] : null,
                ];
            }
        }
        return $sku;
    }

    /**
     * 修改杂志信息
     * @return mixed
     */
    public function update($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'is_show_icon' => isset($params['is_show_icon']) ? $params['is_show_icon'] : null,
            'category_id' => isset($params['category_id']) ? $params['category_id'] : null,
            'face_document_id' => isset($params['face_document_id']) ? $params['face_document_id'] : null,
            'music_document_id' => isset($params['music_document_id']) ? $params['music_document_id'] : null,
            'version' => isset($params['version']) ? $params['version'] : null,
            'magazineInfo' => $this->magazineInfo($params['magazineInfo']),
            'shareMessage' => [
                'id' => isset($params['shareMessage']['id']) ? $params['shareMessage']['id'] : null,
                'title' => isset($params['shareMessage']['title']) ? $params['shareMessage']['title'] : null,
                'desc' => isset($params['shareMessage']['desc']) ? $params['shareMessage']['desc'] : null,
                'pic_id' => isset($params['shareMessage']['documentLib']['id']) ? $params['shareMessage']['documentLib']['id'] : null,
            ],
        ];
        if (is_null($apiParams['shareMessage']['desc'])) {
            $apiParams['shareMessage'] = null;
        }
        $this->getResult('magazine-update', $apiParams);
    }

    /**
     * 修改杂志名称
     * @return mixed
     */
    public function updateName($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null
        ];
        $this->getResult('magazine-update', $apiParams);
    }

    /**
     * 杂志转模板
     * @return mixed
     */
    public function updateToTemplate($params)
    {
        $this->getResult('magazine-update-to-template', $params);
    }

    /**
     * 杂志修改shopid
     * @return mixed
     */
    public function updateShopId($params)
    {
        $this->getResult('magazine-update-shopid', $params);
    }

    /**
     * 获取杂志列表
     * @return mixed
     */
    public function find($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'category_id' => isset($params['category_id']) ? $params['category_id'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('magazine-find', $apiParams);
    }

    /**
     * 增加访问量
     * @return mixed
     */
    public function addPv($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'add_pv' => 1
        ];
        $this->getResult('magazine-pv', $apiParams);
    }

    /**
     * 复制杂志页面
     * @return mixed
     */
    public function copypage($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult('magazine-copypage', $apiParams);
    }

    /**
     * 复制杂志
     * @return mixed
     */
    public function copy($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'magazine_id' => isset($params['magazine_id']) ? $params['magazine_id'] : null,
        ];
        $this->getResult('magazine-copy', $apiParams);
    }

    /**
     * 删除杂志
     * @return mixed
     */
    public function delete($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult('magazine-delete', $apiParams);
    }

    /**
     * 开启杂志
     * @return mixed
     */
    public function open($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult('magazine-open', $apiParams);
    }

    /**
     * 关闭杂志
     * @return mixed
     */
    public function close($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult('magazine-close', $apiParams);
    }

    /**
     * 创建杂志页面
     * @return mixed
     */
    public function createPage($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'magazine_id' => isset($params['magazine_id']) ? $params['magazine_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'content' => isset($params['content']) ? $params['content'] : null,
        ];
        $this->getResult('magazine-create-page', $apiParams);
    }

    /**
     * 删除杂志页面
     * @return mixed
     */
    public function deletePage($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'magazine_id' => isset($params['magazine_id']) ? $params['magazine_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult('magazine-delete-page', $apiParams);
    }

    /**
     * 创建杂志表单
     * @return mixed
     */
    public function createForm($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'magazine_id' => isset($params['magazine_id']) ? $params['magazine_id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'content' => isset($params['content']) ? json_encode($params['content']) : null,
            'button' => isset($params['button']) ? $params['button'] : null,
        ];
        $this->getResult('magazine-create-form', $apiParams);
    }

    /**
     * 获取杂志表单列表
     * @return mixed
     */
    public function findForm($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'magazine_id' => isset($params['magazine_id']) ? $params['magazine_id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'createStart' => isset($params['createStart']) ? $params['createStart'] : null,
            'createEnd' => isset($params['createEnd']) ? $params['createEnd'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('magazine-find-form', $apiParams);
    }

    /**
     * 获取杂志表单详情
     * @return mixed
     */
    public function getForm($params)
    {
        $this->getResult('magazine-get-form', $params);
        if (is_array($this->_data) && count($this->_data)) {
            $this->_data['content'] = json_decode($this->_data['content'], true);
        }
    }

    /**
     * 修改杂志表单详情
     * @return mixed
     */
    public function updateForm($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'content' => isset($params['content']) ? $params['content'] : null,
            'button' => isset($params['button']) ? $params['button'] : null,
        ];
        $this->getResult('magazine-update-form', $apiParams);
    }

    /**
     * 删除杂志表单详情
     * @return mixed
     */
    public function deleteForm($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult('magazine-delete-form', $apiParams);
    }

    /**
     * 创建用户表单报名记录
     * @return mixed
     */
    public function createFormJoin($params)
    {
        $this->getResult('magazine-create-form-join', $params);
    }

    /**
     * 审核用户表单报名记录
     * @return mixed
     */
    public function examineFormJoin($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'valid' => isset($params['valid']) ? $params['valid'] : null,
        ];
        $this->getResult('magazine-examine-form-join', $apiParams);
    }

    /**
     * 获取用户表单报名记录
     * @return mixed
     */
    public function getFormJoin($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'magazine_form_id' => isset($params['magazine_form_id']) ? $params['magazine_form_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult('magazine-get-form-join', $apiParams);
    }

    /**
     * 获取用户表单报名记录列表
     * @return mixed
     */
    public function findFormJoin($params)
    {
        $this->getResult('magazine-find-form-join', $params);
        if (is_array($this->_data['data']) && count($this->_data['data'])) {
            foreach ($this->_data['data'] as $key => $val) {
                $this->_data['data'][$key]['content'] = json_decode($val['content'], true);
            }
        }
    }

    /**
     * 删除用户表单报名记录
     * @return mixed
     */
    public function delFormJoin($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult('magazine-delete-form-join', $apiParams);
    }

    /**
     * 创建杂志分类
     * @return mixed
     */
    public function createCategory($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
        ];
        $this->getResult('magazine-create-category', $apiParams);
    }

    /**
     * 修改杂志分类名称
     * @return mixed
     */
    public function updateCategory($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
        ];
        $this->getResult('magazine-update-category', $apiParams);
    }

    /**
     * 获取杂志分类列表
     * @return mixed
     */
    public function findCategory($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'name' => isset($params['name']) ? $params['name'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('magazine-find-category', $apiParams);
    }

    /**
     * 删除杂志分类
     * @return mixed
     */
    public function delCategory($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult('magazine-delete-category', $apiParams);
    }

    /**
     * 创建杂志模板使用记录
     * @return mixed
     */
    public function addTemplatePv($params)
    {
        //拿接口数据
        $apiParams = [
            'template_id' => isset($params['template_id']) ? $params['template_id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('magazine-template-pv', $apiParams);
    }

    /**
     * 获取杂志模板详情
     * @return mixed
     */
    public function getTemplate($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult('magazine-get-template', $apiParams);
    }

    /**
     * 获取杂志模板列表
     * @return mixed
     */
    public function findTemplate($params)
    {
        //拿接口数据
        $apiParams = [
            'name' => isset($params['name']) ? $params['name'] : null,
            'flag' => isset($params['flag']) ? $params['flag'] : null,
            'category_id' => isset($params['category_id']) ? $params['category_id'] : null,
            'tag_id' => isset($params['tag_id']) ? $params['tag_id'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('magazine-find-template', $apiParams);
    }

    /**
     * 获取杂志模板分类列表
     * @return mixed
     */
    public function findTemplateCategory()
    {
        $this->getResult('magazine-find-template-category', []);
    }

    /**
     * 获取杂志页面模板详情
     * @return mixed
     */
    public function getPageTemplate($params)
    {
        //拿接口数据
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult('magazine-get-template', $apiParams);
    }

    /**
     * 获取杂页面模板列表
     * @return mixed
     */
    public function findPageTemplate($params)
    {
        //拿接口数据
        $apiParams = [
            'name' => isset($params['name']) ? $params['name'] : null,
            'category_id' => isset($params['category_id']) ? $params['category_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('magazine-find-template-page', $apiParams);
    }

    /**
     * 获取杂志页面模板分类列表
     * @return mixed
     */
    public function findPageTemplateCategory()
    {
        $this->getResult('magazine-find-template-page-category', []);
    }

    /**
     * 获取杂志模板标签列表
     * @return mixedPageTemplate
     */
    public function findTemplateTagCategory()
    {
        //拿缓存数组
        $data = $this->magazineCache->findTemplateTagCategory();
        if ($data !== false) {
            return $this->setResult($data);
        }
        $this->getResult('magazine-find-template-tag', []);
        //再从新设置缓存
        if (is_null($this->getError())) {
            $this->magazineCache->findTemplateTagCategory($params, $result);
        }
    }


}
