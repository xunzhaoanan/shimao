<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\services;

use common\cache\BaseCache;
use common\helpers\CommonLib;
use common\models\Document;
use common\vendor\document\DocumentLib;
use common\vendor\upload\cdn\CDN;
use Yii;
use yii\helpers\ArrayHelper;
use yii\base\Model;

class DocumentService extends BaseService
{
	protected $documentModel;

	public function init()
	{
	    $this->documentModel = new Document();
	}

    /**
     * 创建文件
     * 支持单个文件/多个文件
     * 参数必须是文件数组列表
     * @return mixed
     */
	public function create($params)
	{
        foreach($params['list'] as $key=>$val) {
            DocumentLib::getFileType($val['file_cdn_path']);
            if (is_null(DocumentLib::$fileType)) {
                return $this->setError('不支持的文件格式');
            }
            //数据库支持最大长度100，截取，避免超出
            $params['list'][$key]['name'] = CommonLib::utf8Substr($val['name'], 0, 100);
            $params['list'][$key]['shop_id'] = $params['shop_id'];
            $params['list'][$key]['file_type'] = DocumentLib::$fileFormat;
        }
        // 接收数据层处理结果
        $return = [];
        foreach($params['list'] as $val) {
            $this->documentModel->create($val);
            if ( ! is_null($this->documentModel->getError())){
                return $this->setError($this->documentModel->getError());
            }
            $return[] = $this->documentModel->_data;
        }
        $this->setResult($return);
	}

    /**
     * 获取文件列表
     * @return mixed
     */
    public function find($params)
    {
        $this->documentModel->find($params);
        // 接收数据层处理结果
        if ( ! is_null($this->documentModel->getError())){
            return $this->setError($this->documentModel->getError());
        }
        $this->setResult($this->documentModel->_data);
    }

    /**
     * 修改文件
     * @return mixed
     */
    public function update($params)
    {
        $this->documentModel->update($params);
        // 接收数据层处理结果
        if ( ! is_null($this->documentModel->getError())){
            return $this->setError($this->documentModel->getError());
        }
        $this->setResult($this->documentModel->_data);
    }

    /**
     * 删除文件
     * @return mixed
     */
    public function delete($params)
    {
        $this->documentModel->delete($params);
        // 接收数据层处理结果
        if ( ! is_null($this->documentModel->getError())){
            return $this->setError($this->documentModel->getError());
        }
        $this->setResult($this->documentModel->_data);
    }

    /**
     * 批量删除文件
     * @return mixed
     */
    public function multiDelete($params)
    {
        $this->documentModel->multiDelete($params);
        // 接收数据层处理结果
        if ( ! is_null($this->documentModel->getError())){
            return $this->setError($this->documentModel->getError());
        }
        $this->setResult($this->documentModel->_data);
    }

    /**
     * 上传文件到CDN
     * $format ：文件格式
     * 内部调用方法
     * @return mixed
     */
    public function upload($params){
        DocumentLib::getFileType($params['filePath'],$params['postName']);
        if(is_null(DocumentLib::$fileType)){
            return $this->setError('不支持的文件格式');
        }
        //使用CDN接口
        CDN::uploadFile($params['filePath'],$params['fileName'],DocumentLib::$fileType);
        if( is_null(CDN::$cdnData)){
            return $this->setError('远程文件上传失败');
        }
        $cdnData = json_decode(CDN::$cdnData,true);
        # cdn接口不稳定，据说修复了，先注释掉
        if(strpos($cdnData['url'],DocumentLib::$fileType) === false){
            $cdnData['url'] .= ('.'.DocumentLib::$fileType);
        }
        $this->setResult(['file_cdn_path' => $cdnData['url'],'name'=>$params['fileName']]);
    }

    /**
     * 批量修改文档的分类
     * @param $params
     */
    public function multiUpdateDocCategory($params)
    {
        $this->documentModel->multiUpdateDocCategory($params);
        // 接收数据层处理结果
        if ( ! is_null($this->documentModel->getError())){
            return $this->setError($this->documentModel->getError());
        }
        $this->setResult($this->documentModel->_data);
    }

    /**
     * 创建文档分类
     * @param $params
     */
    public function createCategory($params)
    {
        $this->documentModel->createCategory($params);
        // 接收数据层处理结果
        if ( ! is_null($this->documentModel->getError())){
            return $this->setError($this->documentModel->getError());
        }
        $this->setResult($this->documentModel->_data);
    }

    /**
     * 修改文档分类
     * @param $params
     */
    public function updateCategory($params)
    {
        $this->documentModel->updateCategory($params);
        // 接收数据层处理结果
        if ( ! is_null($this->documentModel->getError())){
            return $this->setError($this->documentModel->getError());
        }
        $this->setResult($this->documentModel->_data);
    }

    /**
     * 获取文档分类
     * @param $params
     */
    public function getCategory($params)
    {
        $this->documentModel->getCategory($params);
        // 接收数据层处理结果
        if ( ! is_null($this->documentModel->getError())){
            return $this->setError($this->documentModel->getError());
        }
        $this->setResult($this->documentModel->_data);
    }

    /**
     * 文档分类列表
     * @param $params
     */
    public function findCategory($params)
    {
        $this->documentModel->findCategory($params);
        // 接收数据层处理结果
        if ( ! is_null($this->documentModel->getError())){
            return $this->setError($this->documentModel->getError());
        }
        $this->setResult($this->documentModel->_data);
    }

    /**
     * 删除文档分类
     * @param $params
     */
    public function deleteCategory($params)
    {
        $this->documentModel->deleteCategory($params);
        // 接收数据层处理结果
        if ( ! is_null($this->documentModel->getError())){
            return $this->setError($this->documentModel->getError());
        }
        $this->setResult($this->documentModel->_data);
    }

    /**
     * 创建文件
     * 支持单个文件/多个文件
     * 参数必须是文件数组列表
     * @return mixed
     */
    public function userCreate($params)
    {
        foreach($params['list'] as $key=>$val) {
            DocumentLib::getFileType($val['file_cdn_path']);
            if (is_null(DocumentLib::$fileType)) {
                return $this->setError('不支持的文件格式');
            }
            //数据库支持最大长度100，截取，避免超出
            $params['list'][$key]['name'] = CommonLib::utf8Substr($val['name'], 0, 100);
            $params['list'][$key]['shop_id'] = $params['shop_id'];
            $params['list'][$key]['uid'] = $params['uid'];
            $params['list'][$key]['file_type'] = DocumentLib::$fileFormat;
        }
        // 接收数据层处理结果
        $return = [];
        foreach($params['list'] as $val) {
            $this->documentModel->userCreate($val);
            if ( ! is_null($this->documentModel->getError())){
                return $this->setError($this->documentModel->getError());
            }
            $return[] = $this->documentModel->_data;
        }
        $this->setResult($return);
    }

} 