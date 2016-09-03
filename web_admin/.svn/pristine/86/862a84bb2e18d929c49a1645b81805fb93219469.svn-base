<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */

namespace common\models;

use common\cache\WxMaterialCache;
use Yii;
use yii\base\Model;

/**
 * WxMaterial model
 */
class WxMaterial extends BaseModel
{

    //微信素材类型的图文
    const NEWS_TYPE_WX = 1;
    //活动类型的图文
    const NEWS_TYPE_MODEL = 2;

    # 素材类型
    const TYPE_TEXT = 1 ;
    const TYPE_IMAGE = 2 ;
    const TYPE_NEWS = 3 ;
    const TYPE_VOICE = 4 ;
    const TYPE_VIDEO = 5 ;
    const TYPE_MUSIC = 6 ;
    public static $mediaType = [self::TYPE_TEXT,self::TYPE_IMAGE,self::TYPE_NEWS,self::TYPE_VOICE,self::TYPE_VIDEO,self::TYPE_MUSIC];


    protected $wxMaterialCache ;

    public function init()
    {
        $this->wxMaterialCache = new WxMaterialCache();
    }

    /**
     * 创建文本素材
     * @return mixed
     */
    public function createText($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'reply_content' => isset($params['reply_content']) ? $params['reply_content'] : null,
        ];
        $this->getResult('wx-material-text-create',$apiParams);
    }

    /**
     * 获取文本素材列表
     * @return mixed
     */
    public function findText($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('wx-material-text-list',$apiParams);
    }

    /**
     * 获取文本素材详情
     * @return mixed
     */
    public function getText($params){
        $params['material_type'] = self::TYPE_TEXT;
        $data = $this->wxMaterialCache->getCache($params);
        if($data !== false){
            $this->setResult($data);
            return true;
        }
        $this->getResult('wx-material-text-get',$params);
        //再从新设置缓存
        if ( ! is_null($this->_data)){
            $this->wxMaterialCache->setCache($params,$this->_data);
        }
    }

    /**
     * 修改文本素材
     * @return mixed
     */
    public function updateText($params){
        $params['material_type'] = self::TYPE_TEXT;
        $this->wxMaterialCache->delCache($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'material_id' => isset($params['material_id']) ? $params['material_id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'reply_content' => isset($params['reply_content']) ? $params['reply_content'] : null
        ];
        $this->getResult('wx-material-text-update',$apiParams);
    }

    /**
     * 删除文本素材
     * @return mixed
     */
    public function deleteText($params){
        $params['material_type'] = self::TYPE_TEXT;
        $this->wxMaterialCache->delCache($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'material_id' => isset($params['material_id']) ? $params['material_id'] : null
        ];
        $this->getResult('wx-material-text-del',$apiParams);
    }

    /**
     * 创建图片素材
     * @return mixed
     */
    public function createImage($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'media_id' => isset($params['media_id']) ? $params['media_id'] : null,
            'cdn_path' => isset($params['cdn_path']) ? $params['cdn_path'] : null,
            'wx_url' => isset($params['wx_url']) ? $params['wx_url'] : null,
            'category_id' => isset($params['category_id']) ? $params['category_id'] : null
        ];
        $this->getResult('wx-material-image-create',$apiParams);
    }

    /**
     * 获取图片素材列表
     * @return mixed
     */
    public function findImage($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'category_id' => isset($params['category_id']) ? $params['category_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('wx-material-image-list',$apiParams);
    }

    /**
     * 获取图片素材详情
     * @return mixed
     */
    public function getImage($params){
        //拿缓存数据
        $params['material_type'] = self::TYPE_IMAGE;
        $data = $this->wxMaterialCache->getCache($params);
        if($data !== false){
            $this->setResult($data);
            return true;
        }
        $this->getResult('wx-material-image-get',$params);
        //再从新设置缓存
        if ( ! is_null($this->_data)){
            $this->wxMaterialCache->setCache($params,$this->_data);
        }
    }

    /**
     * 修改图片素材
     * @return mixed
     */
    public function updateImage($params){
        $params['material_type'] = self::TYPE_IMAGE;
        $this->wxMaterialCache->delCache($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'material_id' => isset($params['material_id']) ? $params['material_id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'media_id' => isset($params['media_id']) ? $params['media_id'] : null,
            'cdn_path' => isset($params['cdn_path']) ? $params['cdn_path'] : null,
            'img_url' => isset($params['img_url']) ? $params['img_url'] : null,
            'wx_url' => isset($params['wx_url']) ? $params['wx_url'] : null,
            'category_id' => isset($params['category_id']) ? $params['category_id'] : null
        ];
        $this->getResult('wx-material-image-update',$apiParams);
    }

    /**
     * 修改图片素材，补全wx_url
     * @return mixed
     */
    public function updateImageByMediaId($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'media_id' => isset($params['media_id']) ? $params['media_id'] : null,
            'wx_url' => isset($params['wx_url']) ? $params['wx_url'] : null
        ];
        $this->getResult('wx-material-image-update-by-media-id',$apiParams);
    }

    /**
     * 删除图片素材
     * @return mixed
     */
    public function deleteImage($params){
        $params['material_type'] = self::TYPE_IMAGE;
        $this->wxMaterialCache->delCache($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'material_id' => isset($params['material_id']) ? $params['material_id'] : null
        ];
        $this->getResult('wx-material-image-del',$apiParams);
    }

    /**
     * 创建图文素材
     * @return mixed
     */
    public function createNews($params){
        //拿接口数据
        $apiParams = [
            'news' => [
                'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
                'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
                'title' => isset($params['title']) ? $params['title'] : null,
                'media_id' => isset($params['media_id']) ? $params['media_id'] : null,
                'is_wsh' => isset($params['is_wsh']) ? $params['is_wsh'] : null,
                'type' => 1
            ],
            'item' => $this->formatItem($params['item'])
        ];
        $this->getResult('wx-material-news-create',$apiParams);
    }

    /**
     * 图文素材列表转换
     * @return mixed
     */
    private function formatItem($item){
        return $item;
    }

    /**
     * 获取图文素材列表
     * @return mixed
     */
    public function findNews($params){
        $this->getResult('wx-material-news-list',$params);
    }

    /**
     * 获取图文素材列表（修改返回参数）
     * @return mixed
     */
    public function findNewsNew($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('wx-material-news-list-new',$apiParams);
    }

    /**
     * 获取图文素材详情
     * @return mixed
     */
    public function getNews($params){
        //拿缓存数据
        $params['material_type'] = self::TYPE_NEWS;
        $data = $this->wxMaterialCache->getCache($params);
        if($data !== false){
           $this->setResult($data);
            return true;
        }
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'material_id' => isset($params['material_id']) ? $params['material_id'] : null
        ];
        $this->getResult('wx-material-news-get',$apiParams);
        //再从新设置缓存
        if ( ! is_null($this->_data)){
            $this->wxMaterialCache->setCache($params,$this->_data);
        }
    }

    /**
     * 获取图文素材详情（修改返回参数）
     * @return mixed
     */
    public function getNewsNew($params){
        $this->getResult('wx-material-news-get-new',$params);
    }

    /**
     * 修改图文素材
     * @return mixed
     */
    public function updateNews($params){
        $params['material_id'] = $params['id'];
        $params['material_type'] = self::TYPE_NEWS;
        $this->wxMaterialCache->delCache($params);
        //拿接口数据
        $apiParams = [
            'wxImagetxtReply' => [
                'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
                'id' => isset($params['id']) ? $params['id'] : null,
                'title' => isset($params['title']) ? $params['title'] : null,
                'media_id' => isset($params['media_id']) ? $params['media_id'] : null
            ],
            'wxImagetxtReplyItems' => $this->formatItem($params['wxImagetxtReplyItems'])
        ];
        $this->getResult('wx-material-news-update',$apiParams);
    }

    /**
     * 删除图文素材
     * @return mixed
     */
    public function deleteNews($params){
        $params['material_type'] = self::TYPE_NEWS;
        $this->wxMaterialCache->delCache($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'material_id' => isset($params['material_id']) ? $params['material_id'] : null
        ];
        $this->getResult('wx-material-news-del',$apiParams);
    }

    /**
     * 创建语音素材
     * @return mixed
     */
    public function createVoice($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'media_id' => isset($params['media_id']) ? $params['media_id'] : null,
            'cdn_path' => isset($params['cdn_path']) ? $params['cdn_path'] : null
        ];
        $this->getResult('wx-material-voice-create',$apiParams);
    }

    /**
     * 获取语音素材列表
     * @return mixed
     */
    public function findVoice($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('wx-material-voice-list',$apiParams);
    }

    /**
     * 获取语音素材详情
     * @return mixed
     */
    public function getVoice($params){
        //拿缓存数据
        $params['material_type'] = self::TYPE_VOICE;
        $data = $this->wxMaterialCache->getCache($params);
        if($data !== false){
            $this->setResult($data);
            return true;
        }
        $this->getResult('wx-material-voice-get',$params);
        //再从新设置缓存
        if ( ! is_null($this->_data)){
            $this->wxMaterialCache->setCache($params,$this->_data);
        }
    }

    /**
     * 修改语音素材
     * @return mixed
     */
    public function updateVoice($params){
        $params['material_type'] = self::TYPE_VOICE;
        $this->wxMaterialCache->delCache($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'material_id' => isset($params['material_id']) ? $params['material_id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'media_id' => isset($params['media_id']) ? $params['media_id'] : null,
            'cdn_path' => isset($params['cdn_path']) ? $params['cdn_path'] : null
        ];
        $this->getResult('wx-material-voice-update',$apiParams);
    }

    /**
     * 删除语音素材
     * @return mixed
     */
    public function deleteVoice($params){
        $params['material_type'] = self::TYPE_VOICE;
        $this->wxMaterialCache->delCache($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'material_id' => isset($params['material_id']) ? $params['material_id'] : null
        ];
        $this->getResult('wx-material-voice-del',$apiParams);
    }

    /**
     * 创建音乐素材
     * @return mixed
     */
    public function createMusic($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'music_url' => isset($params['music_url']) ? $params['music_url'] : null,
            'hqmusic_url' => isset($params['hqmusic_url']) ? $params['hqmusic_url'] : null,
            'description' => isset($params['description']) ? $params['description'] : null,
            'thumb_media_id' => isset($params['thumb_media_id']) ? $params['thumb_media_id'] : null,
            'cdn_path' => isset($params['cdn_path']) ? $params['cdn_path'] : null
        ];
        $this->getResult('wx-material-music-create',$apiParams);
    }

    /**
     * 获取音乐素材列表
     * @return mixed
     */
    public function findMusic($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('wx-material-music-list',$apiParams);
    }

    /**
     * 获取音乐素材详情
     * @return mixed
     */
    public function getMusic($params){
        //拿缓存数据
        $params['material_type'] = self::TYPE_MUSIC;
        $data = $this->wxMaterialCache->getCache($params);
        if($data !== false){
            $this->setResult($data);
            return true;
        }
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'material_id' => isset($params['material_id']) ? $params['material_id'] : null
        ];
        $this->getResult('wx-material-music-get',$apiParams);
        //再从新设置缓存
        if ( ! is_null($this->_data)){
            $this->setMaterialCache($params,self::CACHE_KEY_GET_MUSIC,$this->_data);
        }
    }

    /**
     * 修改音乐素材
     * @return mixed
     */
    public function updateMusic($params){
        $params['material_type'] = self::TYPE_MUSIC;
        $this->wxMaterialCache->delCache($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'material_id' => isset($params['material_id']) ? $params['material_id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'music_url' => isset($params['music_url']) ? $params['music_url'] : null,
            'hqmusic_url' => isset($params['hqmusic_url']) ? $params['hqmusic_url'] : null,
            'description' => isset($params['description']) ? $params['description'] : null,
            'thumb_media_id' => isset($params['thumb_media_id']) ? $params['thumb_media_id'] : null,
            'cdn_path' => isset($params['cdn_path']) ? $params['cdn_path'] : null
        ];
        $this->getResult('wx-material-music-update',$apiParams);
    }

    /**
     * 删除音乐素材
     * @return mixed
     */
    public function deleteMusic($params){
        $params['material_type'] = self::TYPE_MUSIC;
        $this->wxMaterialCache->delCache($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'material_id' => isset($params['material_id']) ? $params['material_id'] : null
        ];
        $this->getResult('wx-material-music-del',$apiParams);
    }

    /**
     * 创建视频素材
     * @return mixed
     */
    public function createVideo($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'description' => isset($params['description']) ? $params['description'] : null,
            'media_id' => isset($params['media_id']) ? $params['media_id'] : null,
            'cdn_path' => isset($params['cdn_path']) ? $params['cdn_path'] : null,
        ];
        $this->getResult('wx-material-video-create',$apiParams);
    }

    /**
     * 获取视频素材列表
     * @return mixed
     */
    public function findVideo($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => isset($params['sortStr']) ? $params['sortStr'] : null,
        ];
        $this->getResult('wx-material-video-list',$apiParams);
    }

    /**
     * 获取视频素材详情
     * @return mixed
     */
    public function getVideo($params){
        //拿缓存数据
        $params['material_type'] = self::TYPE_VIDEO;
        $data = $this->wxMaterialCache->getCache($params);
        if($data !== false){
            $this->setResult($data);
            return true;
        }
        $this->getResult('wx-material-video-get',$params);
        //再从新设置缓存
        if ( ! is_null($this->_data)){
            $this->wxMaterialCache->setCache($params,$this->_data);
        }
    }

    /**
     * 修改视频素材
     * @return mixed
     */
    public function updateVideo($params){
        $params['material_type'] = self::TYPE_VIDEO;
        $this->wxMaterialCache->delCache($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'material_id' => isset($params['material_id']) ? $params['material_id'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'description' => isset($params['description']) ? $params['description'] : null,
            'media_id' => isset($params['media_id']) ? $params['media_id'] : null,
            'cdn_path' => isset($params['cdn_path']) ? $params['cdn_path'] : null,
        ];
        $this->getResult('wx-material-music-update',$apiParams);
    }

    /**
     * 删除视频素材
     * @return mixed
     */
    public function deleteVideo($params){
        $params['material_type'] = self::TYPE_VIDEO;
        $this->wxMaterialCache->delCache($params);
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'material_id' => isset($params['material_id']) ? $params['material_id'] : null
        ];
        $this->getResult('wx-material-video-del',$apiParams);
    }



}
