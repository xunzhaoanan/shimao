<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */
namespace common\services\weixin;

use common\models\FxMember;
use common\models\Member;
use common\models\Terminal;
use common\models\Printer;
use common\models\WxQrcode;
use common\services\BaseService;
use common\vendor\wechat\WechatQrcode;
use Yii;
use yii\helpers\ArrayHelper;
use yii\base\Model;

class WxQrcodeService extends BaseService
{
    public $wechatQrcode;
    public $wxQrcodeModel;

    public function __construct($wxconfig = false)
    {
        $this->wxQrcodeModel = new WxQrcode();
        if ($wxconfig) {
            $this->wechatQrcode = new WechatQrcode($wxconfig);
        }
    }

    /**
     * 创建二维码
     */
    public function createQrcode($params)
    {
        //创建微信二维码
        if ($this->_createWxQrcode($params) !== true) {
            return false;
        }
        // 走api，生成二维码数据
        $this->wxQrcodeModel->create($params);
        // 接收数据层处理结果
        if (!is_null($this->wxQrcodeModel->getError())) {
            return $this->setError($this->wxQrcodeModel->getError());
        }
        $this->setResult($this->wxQrcodeModel->_data);
        $params['scene_id'] = isset($this->wxQrcodeModel->_data['scene_id']) ? $this->wxQrcodeModel->_data['scene_id'] : '';
        switch ($params['model']) {
            //把对应的员工或店铺scene_id关联起来
            case WxQrcode::MODEL_FX_MEMBER:
                $this->fxLinkage($params);
                break;
            //店铺二维码
            case WxQrcode::MODEL_TERMINAL:
                $this->terminalLinkage($params);
                break;
            //关联打印机设备
            case WxQrcode::MODEL_PRINTER:
                $this->printerLinkage($params);
                break;
        }
    }

    /**
     * 创建打印机二维码关联
     */
    private function printerLinkage($params)
    {
        //修改数据
//        $params =
//            [
//                'shopSub' => [
//                    'shop_id' => $params['shop_id'],
//                    'id' => $params['shop_sub_id'],
//                ],
//                'shopInfo' => [
//                    'ewm_img' => $this->_getQrcode($params['ticket']),
//                ],
//            ];
//        $model = new Printer();
//        $model->update($params);
    }

    /**
     * 创建分销员二维码关联修改
     */
    private function terminalLinkage($params)
    {
        $params = [
            'shop_sub_id' => $params['shop_sub_id'],
            'shop_id' => $params['shop_id'],
            'scene_id' => $params['scene_id'],
            'ewm_img' => $this->_getQrcode($params['ticket'])
        ];
        $model = new Terminal();
        $model->updateShopInfoEwm($params);
    }

    /**
     * 创建分销员二维码关联修改
     */
    private function fxLinkage($params)
    {
//        //修改分销员数据
//        $params['member_id'] = $params['model_id'];
//        $model = new FxMember();
//        $model->update($params);
    }

    /**
     * 创建微信二维码
     * qrcode_type = 0 ，表示临时二维码，有效期7天
     * qrcode_type = 1 ，表示永久二维码
     * @param $params
     * @return bool
     */
    private function _createWxQrcode(&$params)
    {
        // 走微信，生成二维码
        $params['scene_id'] = strval($this->getSceneId($params));
        //生成永久二维码
        $params['qrcode_type'] = 2;
        //  $params['qrcode_type'] = 0;
        $result = $this->wechatQrcode->getQRCode($params);
        if ($result === false) {
            $this->setError('生成二维码失败');
            return false;
        }
        $params['ticket'] = $result['ticket'];
        $params['url'] = $result['url'];
        return true;
    }

    /**
     * 创建二维码
     */
    public function create($params)
    {
        // 是否支持二维码类型
        if (isset($params['model']) && isset($params['model_id']) && !empty($params['model_id'])) {
            if (!in_array($params['model'], WxQrcode::$qrcodeModel)) {
                return $this->setError('不支持的二维码类型');
            }
            return $this->createQrcode($params);
        }
        return $this->setError('您提交的参数有误');
    }

    /**
     * 通过二维码model和model_id获取二维码图片，不存在就创建
     * auto_build 表示二维码信息不存在时，是否自动创建二维码
     */
    public function getQrcode($params)
    {
        $this->wxQrcodeModel->get($params);
        // 接收数据层处理结果
        if (!is_null($this->wxQrcodeModel->getError())) {
            return $this->setError($this->wxQrcodeModel->getError());
        }
        $qrcodeData = $this->wxQrcodeModel->_data;
        if (!is_null($qrcodeData)) {
            //根据二维码信息兑换二维码
            $this->setResult($this->_getQrcode($qrcodeData['ticket']));
            return true;
        }
        // 如果没有数据，就生成二维码
        if (!isset($params['auto_build']) || !$params['auto_build']) {
            return '';
        }
        $this->create($params);
        //没创建成功，就返回错误
        if (is_null($this->_data)) {
            return $this->setError($this->getError());
        }
        $qrcodeData = $this->wxQrcodeModel->_data;
        //根据二维码信息兑换二维码
        $this->setResult($this->_getQrcode($qrcodeData['ticket']));
        return '';
    }

    /**
     * 通过二维码tikect走微信接口获取二维码图片
     * 内部调用
     */
    private function _getQrcode($ticket)
    {
        $result = $this->wechatQrcode->getQRUrl($ticket);
        // 走发布菜单接口
        if ($result === false) {
            return $this->setError();
        }
        // 处理数据层返回的结果
        return $result;
    }

    /**
     * 获取二维码需要的sceneid
     * 内部调用
     */
    private function getSceneId($params)
    {
        // 走api，获得当前最大的 sceneid
        $this->wxQrcodeModel->getMaxSceneId($params);
        // 接收数据层处理结果
        if (!is_null($this->wxQrcodeModel->getError())) {
            return $this->setError($this->wxQrcodeModel->getError());
        }
        $maxSceneId = intval($this->wxQrcodeModel->_data);
        //防止与迁移数据重复，从100000开始
        $maxSceneId = $maxSceneId <= 100000 ? 100001 : $maxSceneId;
        return ++$maxSceneId;
    }

} 