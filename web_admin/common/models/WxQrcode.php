<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/25
 * Time: 20:05
 */

namespace common\models;

use common\cache\WxQrcodeCache;
use Yii;

/**
 * WxMenu model
 */
class WxQrcode extends BaseModel
{

    // 二维码类型
    const MODEL_PRODUCT = 'product' ;
    const MODEL_SECONDKILL = 'secondkill' ;
    const MODEL_REDPACK_GROUP = 'redpack_group' ;
    const MODEL_REDPACK_TRANSMIT = 'redpack_transmit' ;
    const MODEL_RESERVE = 'reserve' ;
    const MODEL_COLLECT_RECEIVE = 'collectreceive' ;
    const MODEL_COLLECT_ZAN = 'collectzan' ;
    const MODEL_CARD_COUPON = 'cardcoupon' ;
    const MODEL_CASH_REDPACK = 'cashredpack';
    const MODEL_TOGETHER_BUY = 'togetherbuy';
    const MODEL_SIGNIN = 'signin';
    //抽奖活动
    const MODEL_MARKETING_ACTIVITY = 'marketing_activity' ;
    //分销员
    const MODEL_FX_MEMBER = 'fx_member' ;
    //员工
    const MODEL_STAFF = 'staff';
    //员工
    const MODEL_TERMINAL = 'terminal';
    //员工
    const MODEL_WSH_NEWS = 'wsh_news';
    //员工
    const MODEL_MEMBER_CARD = 'member_card';

    /**
     * 打印机
     */
    const MODEL_PRINTER = 'printer';
    //商家二维码
    const MODEL_WSH = 'wsh';

    /**
     * 微信图文
     */
    const MODEL_WX_IMAGETXT_REPLY = 'wx_imagetxt_reply';

    public static $qrcodeModel = [
        self::MODEL_PRODUCT ,
        self::MODEL_SECONDKILL ,
        self::MODEL_REDPACK_GROUP ,
        self::MODEL_REDPACK_TRANSMIT,
        self::MODEL_RESERVE ,
        self::MODEL_COLLECT_RECEIVE ,
        self::MODEL_COLLECT_ZAN ,
        self::MODEL_MARKETING_ACTIVITY ,
        self::MODEL_FX_MEMBER ,
        self::MODEL_STAFF,
        self::MODEL_TERMINAL,
        self::MODEL_CARD_COUPON,
        self::MODEL_PRINTER,
        self::MODEL_CASH_REDPACK,
        self::MODEL_WX_IMAGETXT_REPLY,
        self::MODEL_WSH_NEWS,
        self::MODEL_TOGETHER_BUY,
        self::MODEL_SIGNIN,
        self::MODEL_WSH,
        self::MODEL_MEMBER_CARD,
    ];

    protected $wxQrcodeCache ;

    public function init()
    {
        $this->wxQrcodeCache = new WxQrcodeCache();
    }

    /**
     * 创建微信二维码
     * @return mixed
     */
    public function create($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'scene_id' => isset($params['scene_id']) ? intval($params['scene_id']) : null,
            'ticket' => isset($params['ticket']) ? $params['ticket'] : null,
            'model' => isset($params['model']) ? $params['model'] : null,
            'model_id' => isset($params['model_id']) ? $params['model_id'] : null,
            'type' => 1,
            'type_id' => 1
        ];
        $this->getResult('qrcode-create',$apiParams);
    }

    /**
     * 获取微信二维码详情
     * @return mixed
     */
    public function get($params){
        $data = $this->wxQrcodeCache->getCache($params);
        if($data !== false){
            return $this->setResult($data);
        }
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'scene_id' => isset($params['scene_id']) ? $params['scene_id'] : null,
            'ticket' => isset($params['ticket']) ? $params['ticket'] : null,
            'model' => isset($params['model']) ? $params['model'] : null,
            'model_id' => isset($params['model_id']) ? $params['model_id'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
            'type_id' => isset($params['type_id']) ? $params['type_id'] : null
        ];
        $this->getResult('qrcode-get',$apiParams);
        //再从新设置缓存
        if ( ! is_null($this->_data)){
            $this->wxQrcodeCache->setCache($params, $this->_data);
        }
    }

    /**
     * 增加二维码扫码数
     * @return mixed
     */
    public function addHit($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'scene_id' => isset($params['scene_id']) ? $params['scene_id'] : null
        ];
        $this->getResult('qrcode-add-hit',$apiParams);
    }

    /**
     * 获取商家当前最大的 scene_id
     * @return mixed
     */
    public function getMaxSceneId($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
        ];
        $this->getResult('qrcode-max-scene-id',$apiParams);
    }

    /**
     * 添加关注数
     * @return mixed
     */
    public function addAttention($params){
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'scene_id' => isset($params['scene_id']) ? $params['scene_id'] : null,
        ];
        $this->getResult('qrcode-add-attention',$apiParams);
    }



}
