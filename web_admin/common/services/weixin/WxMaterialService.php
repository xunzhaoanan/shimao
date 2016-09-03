<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\services\weixin;

use common\models\CardCoupon;
use common\models\Collect;
use common\models\MarketActivity;
use common\models\Redpack;
use common\models\Reserve;
use common\models\SecondKill;
use common\models\SelectModel;
use common\models\TogetherBuy;
use common\models\WxMaterial;
use common\models\WxMenu;
use common\services\BaseService;
use common\services\DocumentService;
use common\vendor\document\DocumentLib;
use common\vendor\wechat\WechatMaterial;

class WxMaterialService extends BaseService
{

    protected $wxMaterialModel;
    protected $wxMaterial;

    public function __construct($wxconfig = false)
    {
        if ($wxconfig) {
            $this->wxMaterial = new WechatMaterial($wxconfig);
        }
        $this->wxMaterialModel = new WxMaterial();
    }

    /**
     * 上传永久素材文件
     * @return mixed
     */
    public function upload($params)
    {
        DocumentLib::getFileType($params['filePath']);
        if (is_null(DocumentLib::$fileFormat)) {
            return $this->setError('不支持的文件格式');
        }
        // 上传图片到cdn
        $documentService = new DocumentService();
        $documentService->upload($params);
        if (!is_null($documentService->getError())) {
            return $this->setError('上传远程图片失败');
        }
        $cdnResult = $documentService->_data;
        // 上传图片到微信素材库
        $materialType = null;
        $isVideo = false;
        $videoInfo = [];
        # 获取素材类型
        switch (DocumentLib::$fileFormat) {
            case 1 :
                $materialType = WechatMaterial::TYPE_IMAGE;
                break;
            case 2 :
                $materialType = WechatMaterial::TYPE_VOICE;
                break;
            case 3:
                $materialType = WechatMaterial::TYPE_VOICE;
                break;
            case 4:
                $materialType = WechatMaterial::TYPE_VIDEO;
                $isVideo = true;
                $videoInfo = ['title' => $params['fileName'], 'introduction' => $params['fileName']];
                break;
        }
        if (is_null($materialType)) {
            return $this->setError('不支持的素材格式');
        }
        # 把临时文件改成原图文件路径，不然微信不识别

        move_uploaded_file($params['filePath'], dirname($params['filePath']) . '/' . $params['postName']);
        $filePath = dirname($params['filePath']) . '/' . $params['postName'];
        # 开始上传文件到微信素材库
        $result = $this->wxMaterial->uploadForeverMedia($filePath, $materialType, $isVideo, $videoInfo);
        if ($result && isset($result['media_id'])) {
            $this->setResult(['media_id' => $result['media_id'], 'cdn_path' => $cdnResult['file_cdn_path'], 'name' => $cdnResult['name'], 'wx_url' => $result['url']]);
        } else {
            return $this->setError('素材上传失败，请稍后再试');
        }
    }

//    /**
//     * 获取永久素材文件列表
//     * @return mixed
//     */
//    public function findMaterial($params)
//    {
//        $result = $this->wxMaterial->getForeverList($params['type'],$params['page'],$params['count']);
//        if($result && isset($result['item'])){
//            $this->setResult($result);
//        }else{
//            return $this->setError();
//        }
//    }

    /**
     * 检验并格式化模块 ids
     * @return mixed
     */
    public function setModelByIds($ids)
    {
        // 没有 ids 则返回false
        if (!is_array($ids) || !count($ids)) {
            return false;
        }
        $replyIds = [];
        //如果是一维数据
        if (isset($ids['id'])) {
            if (!in_array($ids['type'], SelectModel::$modelType)) {
                return false;
            } else {
                $replyIds[] = [$ids['type'] => $ids['id']];
            }
        } else {
            //如果是多维数据
            foreach ($ids as $key => $val) {
                if (!in_array($val['type'], SelectModel::$modelType)) {
                    return false;
                } else {
                    $replyIds[] = [$val['type'] => $val['id']];
                }
            }
        }
        return json_encode($replyIds);
    }

    /**
     * 根据ids拿到对应的模块
     * @return mixed
     */
    public function getModelByIds($ids, $shopId, $rand = false)
    {
        $params['shop_id'] = $shopId;
        if (!is_array($ids)) {
            $ids = json_decode($ids, true);
        }
        //有的时候微信事件key会json_encode，所以需要转两次
        if (!is_array($ids)) {
            $ids = json_decode($ids, true);
        }
        if ($rand !== false) {
            $randValue = $ids[mt_rand(0, count($ids) - 1)];
            $ids = [0 => $randValue];
        }
        $reply_ids = [];
        foreach ((array)$ids as $key => $val) {
            foreach ((array)$val as $type => $id) {
                switch ($type) {
                    case SelectModel::MODEL_MARKETING :
                        $model = new MarketActivity();
                        $params['id'] = $id;
                        $model->get($params);
                        $model->_data['desc'] = '大转盘';
                        $model->_data['type'] = SelectModel::MODEL_MARKETING;
                        $model->_data['url'] = getMobileSite() . '/market-activity/activity?id=' . $params['id'];
                        if (!empty($model->_data['startImageTxt'])) {
                            $model->_data['news'] = $model->_data['startImageTxt'];
                            unset($model->_data['startImageTxt']);
                        }
                        $reply_ids[] = $model->_data;
                        break;
                    case SelectModel::MODEL_SMASHEGG :
                        $model = new MarketActivity();
                        $params['id'] = $id;
                        $model->get($params);
                        $model->_data['desc'] = '砸金蛋';
                        $model->_data['type'] = SelectModel::MODEL_SMASHEGG;
                        $model->_data['url'] = getMobileSite() . '/market-activity/activity?id=' . $params['id'];
                        if (!empty($model->_data['startImageTxt'])) {
                            $model->_data['news'] = $model->_data['startImageTxt'];
                            unset($model->_data['startImageTxt']);
                        }
                        $reply_ids[] = $model->_data;
                        break;
                    case SelectModel::TYPE_SECONDKILL :
                        $model = new SecondKill();
                        $params['id'] = $id;
                        $model->secondKillGet($params);
                        $model->_data['desc'] = '秒杀活动';
                        $model->_data['type'] = SelectModel::TYPE_SECONDKILL;
                        $model->_data['url'] = getMobileSite() . '/second-kill/list?id=' . $params['id'];
                        $reply_ids[] = $model->_data;
                        break;
                    case SelectModel::TYPE_REDPACK :
                        $model = new Redpack();
                        $params['id'] = $id;
                        $model->get($params);
                        $model->_data['desc'] = '红包活动';
                        $model->_data['type'] = SelectModel::TYPE_REDPACK;
                        $model->_data['url'] = getMobileSite() . '/grouppack/receive?id=' . $params['id'];
                        $reply_ids[] = $model->_data;
                        break;
                    case SelectModel::TYPE_RESERVE :
                        $model = new Reserve();
                        $params['id'] = $id;
                        $model->get($params);
                        $model->_data['desc'] = '预约';
                        $model->_data['type'] = SelectModel::TYPE_RESERVE;
                        $model->_data['url'] = getMobileSite() . '/reserve/detail?id=' . $params['id'];
                        $reply_ids[] = $model->_data;
                        break;
                    case SelectModel::TYPE_COLLECT_RECEIVE :
                        $model = new Collect();
                        $params = array_merge($params, ['id' => $id, 'type' => Collect::COLLECT_RECEIVE]);
                        $model->get($params);
                        $model->_data['desc'] = '代领众筹';
                        $model->_data['type'] = SelectModel::TYPE_COLLECT_RECEIVE;
                        $model->_data['url'] = getMobileSite() . '/collect-receive/list?id=' . $params['id'];

                        $reply_ids[] = $model->_data;
                        break;
                    case SelectModel::TYPE_COLLECT_ZAN :
                        $model = new Collect();
                        $params = array_merge($params, ['id' => $id, 'type' => Collect::COLLECT_ZAN]);
                        $model->get($params);
                        $model->_data['desc'] = '点赞众筹';
                        $model->_data['type'] = SelectModel::TYPE_COLLECT_ZAN;
                        $model->_data['url'] = getMobileSite() . '/collect-zan/zan?id=' . $params['id'];
                        $reply_ids[] = $model->_data;
                        break;
                    case SelectModel::MODEL_CARD_COUPON :
                        $model = new CardCoupon();
                        $params = array_merge($params, ['id' => $id]);
                        $model->getCardReceive($params);
                        $model->_data['desc'] = '卡券';
                        $model->_data['type'] = SelectModel::MODEL_CARD_COUPON;
                        $model->_data['url'] = getMobileSite() . '/card-coupons/card?id=' . $params['id'];
                        $reply_ids[] = $model->_data;
                        break;
                    case SelectModel::MODEL_TOGETHER_BUY :
                        $model = new TogetherBuy();
                        $params = array_merge($params, ['id' => $id]);
                        $model->togetherBuyGet($params);
                        $model->_data['desc'] = '拼团';
                        $model->_data['type'] = SelectModel::MODEL_TOGETHER_BUY;
                        if(isset($model->_data['togetherBuy']['togetherBuyGoods'][0])){
                            $model->_data['url'] = getMobileSite() . '/together-buy/detail?id=' . $model->_data['togetherBuy']['togetherBuyGoods'][0]['id'] .'&act_id='. $params['id'];
                        }else{
                            $model->_data['url'] = getMobileSite() . '/together-buy/list';
                        }

                        $reply_ids[] = $model->_data;
                        break;
                }
            }
        }
        return $reply_ids;
    }

    /**
     * 检验并格式化微信素材 ids
     * @return mixed
     */
    public function setMaterialByIds($ids)
    {
        // 没有 ids 则返回false
        if (!is_array($ids) || !count($ids)) {
            return false;
        }
        $replyIds = [];
        //如果是一维数据
        if (isset($ids['id'])) {
            if (!in_array($ids['type'], WxMaterial::$mediaType)) {
                return false;
            } else {
                $replyIds[] = [$ids['type'] => $ids['id']];
            }
        } else {
            //如果是多维数据
            foreach ($ids as $key => $val) {
                if (!in_array($val['type'], WxMaterial::$mediaType)) {
                    return false;
                } else {
                    $replyIds[] = [$val['type'] => $val['id']];
                }
            }
        }
        return json_encode($replyIds);
    }

    /**
     * 根据ids拿到对应的素材
     * @return mixed
     */
    public function getMaterialByIds($ids, $shopId, $rand = false)
    {
        $params['shop_id'] = $shopId;
        $params['isRelation'] = true;
        $ids = json_decode($ids, true);
        //有的时候微信事件key会json_encode，所以需要转两次
        if (!is_array($ids)) {
            $ids = json_decode($ids, true);
        }
        if ($rand !== false) {
            $randValue = $ids[mt_rand(0, count($ids) - 1)];
            $ids = [0 => $randValue];
        }
        $reply_ids = [];
        foreach ((array)$ids as $key => $val) {
            foreach ((array)$val as $type => $id) {
                switch ($type) {
                    case WxMaterial::TYPE_TEXT :
                        $params['material_id'] = $id;
                        $this->wxMaterialModel->getText($params);
                        $this->wxMaterialModel->_data['desc'] = '文本';
                        $this->wxMaterialModel->_data['type'] = WxMaterial::TYPE_TEXT;
                        $this->wxMaterialModel->_data['reply_content'] = json_decode($this->wxMaterialModel->_data['reply_content'],true) ? json_decode($this->wxMaterialModel->_data['reply_content'],true) : $this->wxMaterialModel->_data['reply_content'];
                        $reply_ids[] = $this->wxMaterialModel->_data;
                        break;
                    case WxMaterial::TYPE_IMAGE :
                        $params['material_id'] = $id;
                        $this->wxMaterialModel->getImage($params);
                        $this->wxMaterialModel->_data['desc'] = '图片';
                        $this->wxMaterialModel->_data['type'] = WxMaterial::TYPE_IMAGE;
                        $reply_ids[] = $this->wxMaterialModel->_data;
                        break;
                    case WxMaterial::TYPE_NEWS :
                        $params['material_id'] = $id;
                        $this->wxMaterialModel->getNewsNew($params);
                        $this->wxMaterialModel->_data['desc'] = '图文';
                        $this->wxMaterialModel->_data['type'] = WxMaterial::TYPE_NEWS;
                        $reply_ids[] = $this->wxMaterialModel->_data;
                        break;
                    case WxMaterial::TYPE_VOICE :
                        $params['material_id'] = $id;
                        $this->wxMaterialModel->getVoice($params);
                        $this->wxMaterialModel->_data['desc'] = '语音';
                        $this->wxMaterialModel->_data['type'] = WxMaterial::TYPE_VOICE;
                        $reply_ids[] = $this->wxMaterialModel->_data;
                        break;
                    case WxMaterial::TYPE_MUSIC :
                        $params['material_id'] = $id;
                        $this->wxMaterialModel->getMusic($params);
                        $this->wxMaterialModel->_data['desc'] = '音乐';
                        $this->wxMaterialModel->_data['type'] = WxMaterial::TYPE_MUSIC;
                        $reply_ids[] = $this->wxMaterialModel->_data;
                        break;
                    case WxMaterial::TYPE_VIDEO :
                        $params['material_id'] = $id;
                        $this->wxMaterialModel->getVideo($params);
                        $this->wxMaterialModel->_data['desc'] = '视频';
                        $this->wxMaterialModel->_data['type'] = WxMaterial::TYPE_VIDEO;
                        $reply_ids[] = $this->wxMaterialModel->_data;
                        break;
                }
            }
        }
        return $reply_ids;
    }

    /**
     * 创建文本素材
     * @return mixed
     */
    public function createText($params)
    {
        $this->wxMaterialModel->createText($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 获取文本素材详情
     * @return mixed
     */
    public function getText($params)
    {
        $this->wxMaterialModel->getText($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->wxMaterialModel->_data['reply_content'] = json_decode($this->wxMaterialModel->_data['reply_content'],true) ? json_decode($this->wxMaterialModel->_data['reply_content'],true) : $this->wxMaterialModel->_data['reply_content'];
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 转换表情
     */
    public function exchangeFace($arr,$keys){
        if(is_array($arr) && count($arr)){
            foreach($arr as $key=>$val){
                $arr[$key][$keys] = json_decode($val[$keys],true) ? json_decode($val[$keys],true) : $val[$keys];
            }
        }
        return $arr;
    }

    /**
     * 获取文本素材列表
     * @return mixed
     */
    public function findText($params)
    {
        $this->wxMaterialModel->findText($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->wxMaterialModel->_data['data'] = $this->exchangeFace($this->wxMaterialModel->_data['data'],'reply_content');
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 修改文本素材
     * @return mixed
     */
    public function updateText($params)
    {
        $this->wxMaterialModel->updateText($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 删除文本素材
     * @return mixed
     */
    public function deleteText($params)
    {
        $this->wxMaterialModel->deleteText($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 创建图片素材
     * $a = $this->wxMaterial->uploadMedia('@C:\Users\Public\Pictures\Sample Pictures\1.jpg',WechatMaterial::TYPE_IMAGE);
     * pr($a);
     * @return mixed
     */
    public function createImage($params)
    {
        $this->wxMaterialModel->createImage($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 获取图片素材详情
     * @return mixed
     */
    public function getImage($params)
    {
        $this->wxMaterialModel->getImage($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 获取图片素材列表
     * @return mixed
     */
    public function findImage($params)
    {
        //$this->wxMaterial->getMedia();
        $this->wxMaterialModel->findImage($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 获取微信图片素材列表
     * @return mixed
     */
    public function findWxImage($params)
    {
        $result = $this->wxMaterial->getForeverList('image', $params['page']*$params['count'], $params['count']);
        if (!$result) {
            return $this->setError('获取微信素材列表失败');
        }else{
            $rtn['page']['current_page'] = $params['page'];
            $rtn['page']['per_page'] = $params['count'];
            $rtn['page']['total_count'] = $result['total_count'];
            $rtn['page']['total_page'] = intval($result['total_count']/$params['count']);
            foreach($result['item'] as $key => $value){
                $rtn['data'][$key]['media_id'] = $value['media_id'];
                $rtn['data'][$key]['cdn_path'] = $value['url'];
            }
            $this->setResult($rtn);
        }
    }

    /**
     * 同步微信图片url到数据库
     * @return mixed
     */
    public function WxImageUrlToDb($params)
    {
        $result = $this->wxMaterial->getForeverCount();
        $num = 20;//一次最多获取20项
        if($result['image_count']){
            $count = intval($result['image_count']/$num);
            for($i = 0; $i <= $count; $i++){
                $result_list = $this->wxMaterial->getForeverList('image', $num*$i, $num);
                if($result_list){
                    foreach($result_list['item'] as $key => $value){
                        $params['media_id'] = $value['media_id'];
                        $params['wx_url'] = $value['url'];

                        echo $value['media_id'].'|';
                        $this->wxMaterialModel->updateImageByMediaId($params);
//                        // 接收数据层处理结果
//                        if (!is_null($this->wxMaterialModel->getError())) {
//                            return $this->setError($this->wxMaterialModel->getError());
//                        }
//                        $this->setResult($this->wxMaterialModel->_data);
                    }
                }
            }
        }else{
            echo '0';
        }
    }

    /**
     * 修改图片素材
     * @return mixed
     */
    public function updateImage($params)
    {
        $this->wxMaterialModel->updateImage($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 删除图片素材
     * @return mixed
     */
    public function deleteImage($params)
    {
        //走微信接口删除图片素材
        $this->wxMaterialModel->getImage($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $wxImg = $this->wxMaterialModel->_data;
        if($wxImg['media_id']){
            $media_id = $wxImg['media_id'];
            $result = $this->wxMaterial->delForeverMedia($media_id);
            if (!$result) {
                return $this->setError('删除微信图片素材失败');
            }
            $this->wxMaterialModel->deleteImage($params);
            // 接收数据层处理结果
            if (!is_null($this->wxMaterialModel->getError())) {
                return $this->setError($this->wxMaterialModel->getError());
            }
            $this->setResult($this->wxMaterialModel->_data);
        }else{
            return $this->setError('获取微信图片素材失败');
        }
    }

    /**
     * 创建图文素材
     * @return mixed
     */
    public function createWshNews($params)
    {
        if(count($params['item']) > 8){
            return $this->setError('不能添加超过八段图文素材');
        }
        foreach($params['item'] as $key=>$val){
            switch($val['link_type']){
                // 如果是回复活动类型，就检验并格式化ids
                case WxMenu::MENU_TYPE_MODEL:
                    $params['item'][$key]['link_param'] = $this->setModelByIds($val['link_param']);
                    if ($params['item'][$key]['link_param'] === false) {
                        return $this->setError('不支持的回复模块类型');
                    }
                    break;
                // 如果是链接类型，就只给链接
                case WxMenu::MENU_TYPE_VIEW:
                    break;
            }
        }
        $this->wxMaterialModel->createNews($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 修改图文素材
     * @return mixed
     */
    public function updateWshNews($params)
    {
        if(count($params['wxImagetxtReplyItems']) > 8){
            return $this->setError('不能添加超过八段图文素材');
        }
        foreach($params['wxImagetxtReplyItems'] as $key=>$val){
            switch($val['link_type']){
                // 如果是回复活动类型，就检验并格式化ids
                case WxMenu::MENU_TYPE_MODEL:
                    $params['wxImagetxtReplyItems'][$key]['link_param'] = $this->setModelByIds($val['link_param']);
                    if ($params['wxImagetxtReplyItems'][$key]['link_param'] === false) {
                        return $this->setError('不支持的回复模块类型');
                    }
                    break;
                // 如果是链接类型，就只给链接
                case WxMenu::MENU_TYPE_VIEW:
                    break;
            }
        }
        $this->wxMaterialModel->updateNews($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 创建图文素材
     * @return mixed
     */
    public function createNews($params, $wxConfig)
    {
        if(count($params['item']) > 8){
            return $this->setError('不能添加超过八段图文素材');
        }
        //走微信接口
        foreach ($params['item'] as $val) {
            if( ! $val['url']){
                $val['url'] =  getMobileSite().'/mall/index';
            }
            //图文正文中的图片地址替换为微信图片地址
            if( !empty($val['imageList'])){
                foreach($val['imageList'] as $img){
                    if($img['wx_url']){
                        $val['content'] = str_replace($img['cdn_path'], $img['wx_url'], $val['content']);
                    }
                }
            }
            $newsParams['articles'][] = [
                'title' => $val['title'],
                'thumb_media_id' => $val['media_id'],
                'author' => $wxConfig['author'],
                'digest' => $val['description'],
                'show_cover_pic' => $val['show_cover_pic'] == 2 ? 0 : 1,
                'content' => $val['content'],
                'content_source_url' => $val['url'],
            ];
        }
        $mediaId = $this->wxMaterial->uploadForeverArticles($newsParams);
        if (!$mediaId) {
            return $this->setError('创建微信图文素材失败');
        }
        $wxUrl = $this->wxMaterial->getForeverMedia($mediaId['media_id']);
        if (!$wxUrl) {
            return $this->setError('创建微信图文素材失败');
        }
        foreach ($params['item'] as $key => $val) {
            $params['item'][$key]['wx_url'] = $wxUrl['news_item'][$key]['url'];
        }
        $params['media_id'] = $mediaId['media_id'];
        //走api
        $this->wxMaterialModel->createNews($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 获取图文素材详情
     * @return mixed
     */
    public function getNews($params)
    {
        $this->wxMaterialModel->getNews($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 获取图文素材详情（修改返回参数）
     * @return mixed
     */
    public function getNewsNew($params)
    {
        $this->wxMaterialModel->getNewsNew($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $data = $this->wxMaterialModel->_data;
        if( $data['is_wsh'] == 1){
            foreach ($data['wxImagetxtReplyItems'] as $key => $val) {
                switch ($val['link_type']) {
                    //如果回复类型是模块，就去格式化微信素材回复key
                    case 2 :
                        $data['wxImagetxtReplyItems'][$key]['link_param'] = $this->getModelByIds($data['wxImagetxtReplyItems'][$key]['link_param'], $params['shop_id']);
                        break;
                }
            }
        }
        $this->setResult($data);
    }

    /**
     * 获取图文素材列表
     * @return mixed
     */
    public function findNews($params)
    {
        $this->wxMaterialModel->findNews($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 获取图文素材列表（修改返回参数）
     * @return mixed
     */
    public function findNewsNew($params)
    {
        $this->wxMaterialModel->findNewsNew($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * @param $data
     * @return mixed
     * 图文正文中的图片地址替换为微信图片地址
     */
    private function getWxContent($data){
        pr(str_replace('wxurl="','src="',$data));
        $chat = '<img';
        $r = explode($chat,$data);
        if(count($r) < 2){
            return $data;
        }
        $str = $r[0].$chat;
        for($i=0;$i<count($r);$i++){
            preg_match_all('/<.*?>(.*?)<\/.*?>/is',$str,$array);
            str_replace('wxurl="','src="',$data);
            $str = $str.$chat.$array;
        }
        return $str;
    }

    /**
     * 修改图文素材
     * @return mixed
     */
    public function updateNews($modelData, $wxConfig)
    {
        if(count($modelData['wxImagetxtReplyItems']) > 8){
            return $this->setError('不能添加超过八段图文素材');
        }
        //走微信接口，由于修改接口有问题！！
        //1、删除这个素材
        $this->wxMaterial->delForeverMedia($modelData['media_id']);
        foreach ($modelData['wxImagetxtReplyItems'] as $val) {
//            if( !empty($val['imageList'])){
//                foreach($val['imageList'] as $img){
//                    if($img['wx_url']){
//                        $val['content'] = str_replace($img['cdn_path'], $img['wx_url'], $val['content']);
//                    }
//                }
//            }
            $newsParams['articles'][] = [
                'title' => $val['title'],
                'thumb_media_id' => $val['media_id'],
                'author' => $wxConfig['author'],
                'digest' => $val['description'],
                'show_cover_pic' => $val['show_cover_pic'] == 2 ? 0 : 1,
                'content' => str_replace('wxurl="','src="',$val['content']),
                'content_source_url' => $val['url'],
            ];
        }
        //2、重新上传素材
        $mediaId = $this->wxMaterial->uploadForeverArticles($newsParams);
        if (!$mediaId) {
            return $this->setError('编辑微信图文素材失败');
        }
        //3、获取素材 media_id
        $wxUrl = $this->wxMaterial->getForeverMedia($mediaId['media_id']);
        if (!$wxUrl) {
            return $this->setError('编辑微信图文素材失败');
        }
        //修改数据
        $modelData['media_id'] = $mediaId['media_id'];
        foreach ($modelData['wxImagetxtReplyItems'] as $key => $val) {
            $modelData['wxImagetxtReplyItems'][$key]['wx_url'] = $wxUrl['news_item'][$key]['url'];
        }
        $this->wxMaterialModel->updateNews($modelData);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 删除图文素材
     * @return mixed
     */
    public function deleteNews($params)
    {
        $this->wxMaterialModel->getNewsNew($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $data = $this->wxMaterialModel->_data;
        $this->wxMaterial->delForeverMedia($data['media_id']);
        $this->wxMaterialModel->deleteNews($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 创建语音素材
     * @return mixed
     */
    public function createVoice($params)
    {
        $this->wxMaterialModel->createVoice($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 获取语音素材详情
     * @return mixed
     */
    public function getVoice($params)
    {
        $this->wxMaterialModel->getVoice($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 获取语音素材列表
     * @return mixed
     */
    public function findVoice($params)
    {
        $this->wxMaterialModel->findVoice($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 修改语音素材
     * @return mixed
     */
    public function updateVoice($params)
    {
        $this->wxMaterialModel->updateVoice($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 删除语音素材
     * @return mixed
     */
    public function deleteVoice($params)
    {
        $this->wxMaterialModel->deleteVoice($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 创建音乐素材
     * @return mixed
     */
    public function createMusic($params)
    {
        $this->wxMaterialModel->createMusic($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 获取音乐素材详情
     * @return mixed
     */
    public function getMusic($params)
    {
        $this->wxMaterialModel->getMusic($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 获取音乐素材列表
     * @return mixed
     */
    public function findMusic($params)
    {
        $this->wxMaterialModel->findMusic($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 修改音乐素材
     * @return mixed
     */
    public function updateMusic($params)
    {
        $this->wxMaterialModel->updateMusic($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 删除音乐素材
     * @return mixed
     */
    public function deleteMusic($params)
    {
        $this->wxMaterialModel->deleteMusic($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 创建视频素材
     * @return mixed
     */
    public function createVideo($params)
    {
        $this->wxMaterialModel->createVideo($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 获取视频素材详情
     * @return mixed
     */
    public function getVideo($params)
    {
        $this->wxMaterialModel->getVideo($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 获取视频素材列表
     * @return mixed
     */
    public function findVideo($params)
    {
        $this->wxMaterialModel->findVideo($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 修改视频素材
     * @return mixed
     */
    public function updateVideo($params)
    {
        $this->wxMaterialModel->updateVideo($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }

    /**
     * 删除视频素材
     * @return mixed
     */
    public function deleteVideo($params)
    {
        $this->wxMaterialModel->deleteVideo($params);
        // 接收数据层处理结果
        if (!is_null($this->wxMaterialModel->getError())) {
            return $this->setError($this->wxMaterialModel->getError());
        }
        $this->setResult($this->wxMaterialModel->_data);
    }


}