<?php
/**
 * Author: zhangjn
 * Date: 2015/9/8
 * Time: 11:05
 */

namespace common\models;

use common\cache\PrinterCache;
use common\helpers\ImageHelper;
use Yii;

/**
 * printer model
 */
class Printer extends BaseModel
{

    /**
     * 微信创厂商值
     */
    const FACTORY_WEIXINCHUANG = 1;


    /**
     * 明信片模式
     */
    const PRINTTYPE_POSTCARD = 1;
    /**
     * 文字模式
     */
    const PRINTTYPE_WORD = 2;
    /**
     * 小广告卡模式
     */
    const PRINTTYPE_WORDAD = 3;
    /**
     * 大广告卡模式
     */
    const PRINTTYPE_AD = 4;

    public static $printType = array(
        self::PRINTTYPE_POSTCARD => '明信卡',
        self::PRINTTYPE_WORD => '文字卡',
        self::PRINTTYPE_WORDAD => '小广告卡',
        self::PRINTTYPE_AD => '广告卡'
    );

    /**
     * 打印机设备类型
     * @var array
     */
    public static $clientTypeList = array(
        1 => 'V-box巨屏版',
        2 => 'V-box四格版',
        3 => 'M-box双屏A版',
        4 => 'M-box双屏B版',
        5 => 'M-box三屏A版',
        6 => 'M-box三屏B版'
    );
    /**
     *打印机类型归类
     * @var type
     */
    public static $cateClientTypeList = array(
        self::FACTORY_WEIXINCHUANG => array(
            array('name' => '小打印机', 'types' => array(1, 2)),//小打印机下面的类型
            array('name' => '大打印机', 'types' => array(3, 4, 5, 6))//大打印机下面的类型
        )
    );
    /**
     * 打印素材类型类型
     * @var array
     */
    public static $materialsTypeList = array(
        1 => '图片',
        2 => '视频',
    );

    /**
     * 是否获取门店信息
     */
    const WITHSHOP_TEMP = 1;

    /**
     * 超过设备限制的code值
     */
    const LIMIT_PRINT_CODE_DEVICE = 123204003;
    /**
     * 超过用户限制的code值
     */
    const LIMIT_PRINT_CODE_USER = 123204004;

    /**
     * 无超过打印限制值
     */
    const LIMIT_PRINT_STATUS_SUCC = 1;
    /**
     * 超过设备打印限制值
     */
    const LIMIT_PRINT_STATUS_DEVICEFAIL = 2;
    /**
     * 超过用户打印限制值
     */
    const LIMIT_PRINT_STATUS_USERFAIL = 3;
    /**
     * 获取打印限制异常值
     */
    const LIMIT_PRINT_STATUS_FAIL = 4;


    /**
     * 打印成功
     */
    const PRINT_SUCC = 1;
    /**
     * 打印验证码错误
     */
    const PRINT_CODE_FAIL = 123204005;

    /**
     * 微商户，打印机默认的二维码账户
     */
    const DEFAULT_WX_ACCOUNT = 'weishanghu2014';

    /**
     * 默认打印机二维码参数的前缀
     */
    const DEFAULT_QR_PREFIX = 'printer_wsh_';

    /**
     * 根据设备类型获取对应图片内容的尺寸
     * @param $clientType
     * @param $printType
     * @param $factory
     * @return array
     */
    private function _getSizeV($clientType, $printType, $factory)
    {
        switch ($factory) {
            case self::FACTORY_WEIXINCHUANG:
                return $this->_getSizeV_WXC($clientType, $printType);
                break;
        }
        return array();
    }

    /**
     * 微信创对应的尺寸
     * @param $clientType
     * @param $printType
     * @return array
     */
    private function _getSizeV_WXC($clientType, $printType)
    {
        $back = array();
        switch ($clientType) {
            case 1://小打印机
            case 2:

                //小打印机的图片尺寸必须是1000*1418，而图片打印出来的尺寸是250*380
                //由于按官方的尺寸比例，满屏展示时会出现图片内容不能完全展示出来，所以这里按照图片的大概尺寸，然后通过设置白边来达到满屏显示图片内容
                $imageW = 1000;
                $imageH = 1418;
                $wRank = $imageW / 250;
                $hRank = $imageH / 380;
                $back['margin'] = array('ml' => (int)(0 * $wRank), 'mr' => (int)(16 * $wRank), 'mt' => (int)(0 * $hRank), 'mb' => (int)(0 * $hRank));//合成后整个图片的边距
                $back['w'] = $imageW - $back['margin']['ml'] - $back['margin']['mr'];//图片内容宽度(不包括白边)
                $back['h'] = $imageH - $back['margin']['mt'] - $back['margin']['mb'];//图片内容高度
                $back['fontSuo'] = [$wRank, $hRank];
                if ($printType == self::PRINTTYPE_WORDAD) {//小广告
                    $bottomContent = 75 * $hRank;//底部内容高度
                    $bottomMt = 10 * $hRank;//底部内容的上边距
                    $mlRightAd = 5 * $wRank;//广告左边距
                    $adW = 75 * $wRank;//小广告图片的宽度
                    $back['rightAd']['w'] = (int)$adW;//小广告图片的宽度
                    $back['rightAd']['h'] = (int)$bottomContent;//小广告图片的高度

                    $addM = 10 * $wRank;//小广告需要与右边和底部有边距，

                    $back['text']['w'] = $back['w'] - $adW - $mlRightAd - $addM;//文字图片的宽度
                    $back['rightAd']['l'] = $back['text']['w'] + $mlRightAd;//右边广告的x位置

                    $back['h'] -= (int)$addM;//底部需空10px
                    $back['margin']['mb'] += (int)$addM;
                } else if ($printType == self::PRINTTYPE_AD) {//大广告
                    $bottomContent = 75 * $hRank;//底部内容高度
                    $bottomMt = 10 * $hRank;//底部内容的上边距
                    $back['ad']['w'] = (int)$back['w'];//广告的宽度
                    $back['ad']['h'] = (int)$bottomContent;//广告图片的高度

                    $back['h'] -= (int)(10 * $hRank);//底部需空10px
                    $back['margin']['mb'] += (int)(10 * $hRank);
                } else if ($printType == self::PRINTTYPE_WORD) {//文字
                    $bottomMt = (int)(10 * $hRank);//底部内容的上边距
                    $bottomContent = 75 * $hRank;//底部内容高度

                    $back['h'] -= (int)(10 * $hRank);//底部需空10px
                    $back['margin']['mb'] += (int)(10 * $hRank);
                } else { //明信片
                    $bottomMt = 0;//底部内容的上边距
                    $bottomContent = 0;
                }
                $back['bottomContent']['h'] = $bottomContent;//底部内容高度
                $back['bottomContent']['mt'] = $bottomMt;//底部内容的上边距
                break;

            case 3://大打印机
            case 4:
            case 5:
            case 6:
                //大打印机的图片尺寸必须是1240*1844，而图片打印出来的尺寸是370*560
                //由于按官方的尺寸比例，满屏展示时会出现图片内容不能完全展示出来，所以这里按照图片的大概尺寸，然后通过设置白边来达到满屏显示图片内容
                $imageW = 1240;
                $imageH = 1844;
                $wRank = $imageW / 370;
                $hRank = $imageH / 560;
                $back['margin'] = array('ml' => (int)(2 * $wRank), 'mr' => (int)(2 * $wRank), 'mt' => (int)(6 * $hRank), 'mb' => (int)(6 * $hRank));//合成后整个图片的边距
                $back['w'] = $imageW - $back['margin']['ml'] - $back['margin']['mr'];//图片内容宽度(不包括白边)
                $back['h'] = $imageH - $back['margin']['mt'] - $back['margin']['mb'];//图片内容高度
                $back['fontSuo'] = [$wRank, $hRank];
                if ($printType == self::PRINTTYPE_WORDAD) {
                    $bottomContent = 100 * $hRank;//底部内容高度
                    $bottomMt = 10 * $hRank;//底部内容的上边距
                    $mlRightAd = 5 * $wRank;//广告左边距
                    $adW = 100 * $wRank;//小广告图片的宽度
                    $back['rightAd']['w'] = (int)$adW;//小广告图片的宽度
                    $back['rightAd']['h'] = (int)$bottomContent;//小广告图片的高度

                    $addM = 10 * $wRank;//小广告需要与右边和底部有边距，

                    $back['text']['w'] = $back['w'] - $adW - $mlRightAd - $addM;//文字图片的宽度
                    $back['rightAd']['l'] = $back['text']['w'] + $mlRightAd;//右边广告的x位置

                    $back['h'] -= (int)$addM;//底部需空10px
                    $back['margin']['mb'] += (int)$addM;
                } else if ($printType == self::PRINTTYPE_AD) {
                    $bottomContent = 100 * $hRank;//底部内容高度
                    $bottomMt = 10 * $hRank;//底部内容的上边距

                    $back['ad']['w'] = (int)$back['w'];//广告的宽度
                    $back['ad']['h'] = (int)$bottomContent;//广告图片的高度

                    $back['h'] -= (int)(10 * $hRank);//底部需空10px
                    $back['margin']['mb'] += (int)(10 * $hRank);
                } else if ($printType == self::PRINTTYPE_WORD) {
                    $bottomMt = (int)(10 * $hRank);//底部内容的上边距
                    $bottomContent = 100 * $hRank;//底部内容高度

                    $back['h'] -= (int)(10 * $hRank);//底部需空10px
                    $back['margin']['mb'] += (int)(10 * $hRank);
                } else {//满屏显示
                    $bottomContent = 0;//底部内容高度
                    $bottomMt = 0;
                }
                $back['bottomContent']['h'] = $bottomContent;//底部内容高度
                $back['bottomContent']['mt'] = $bottomMt;//底部内容的上边距
                break;
        }
        return $back;
    }

    /**
     * 获取图片的裁剪比例
     * @param int $clientType 设备类型
     * @param int $printType 打印类型
     * @param $factory
     * @return null
     */
    public function getRate($clientType, $printType, $factory)
    {
        $back = $this->_getSizeV($clientType, $printType, $factory);
        if (empty($back))
            return null;
        return $back['w'] / ($back['h'] - $back['bottomContent']['h'] - $back['bottomContent']['mt']);//实际的图片宽高比例
    }

    /**
     * 裁剪时图片允许的最小尺寸
     * @param $clientType
     * @param $printType
     * @param $factory
     * @return array
     */
    public function getMinSize($clientType, $printType, $factory)
    {
        $back = $this->_getSizeV($clientType, $printType, $factory);
        $minArr = array();
        if (empty($back))
            return $minArr;
        switch ($printType) {
            case self::PRINTTYPE_POSTCARD:
                $minArr['w'] = $back['w'];
                $minArr['h'] = $back['h'];
                break;
            case self::PRINTTYPE_WORD:
            case self::PRINTTYPE_WORDAD:
            case self::PRINTTYPE_AD:
                $minArr['w'] = $back['w'];
                $minArr['h'] = $back['h'] - $back['bottomContent']['h'] - $back['bottomContent']['mt'];//实际的图片高
                break;
        }
        return $minArr;
    }

    /**
     * 获取合并后的地址
     * @param $clientId 设备id
     * @param $img 上传的图片地址
     * @param $word 输入的文字
     * @param $factory
     * @return bool|null|string
     */
    public function getMergeImg($shopId, $clientId, $img, $word, $factory)
    {
        $apiParams = [
            'id' => $clientId,
            'shop_id' => $shopId,
            'factory' => $factory
        ];
        $this->getResult('printer-client-info-get', $apiParams);

        if (is_null($this->_data)) {
            return false;
        }

        $backData = $this->_data;
        $imgHelper = new ImageHelper();
        $allowSize = null;
        $printType = $backData['print_type'];
        $sizeInfo = $this->_getSizeV($backData['client_type'], $printType, $factory);
        if (empty($sizeInfo))
            return $img;
        switch ($printType) {
            case self::PRINTTYPE_POSTCARD://不需要合并的，明信片模式
                $datas = array();
                $datas[] = array('v' => $img, 'w' => $sizeInfo['w'], 'h' => $sizeInfo['h'], 'cutT' => 2);
                return $imgHelper->mergeAll($datas, $allowSize, $sizeInfo['margin']);
                break;
            case self::PRINTTYPE_WORD://文字
                //合并
                $datas = array();
                if (empty($word))
                    $h = 0;
                else
                    $h = $sizeInfo['bottomContent']['h'] + $sizeInfo['bottomContent']['mt'];
                $datas[] = array('v' => $img, 'w' => $sizeInfo['w'], 'h' => $sizeInfo['h'] - $h, 'cutT' => 2);//图片，高度需减去文字图片的高度以及边距
                if (!empty($word))
                    $datas[] = array('v' => $word, 'ty' => 2, 'rely' => 0, 'l' => 0, 'w' => $sizeInfo['w'], 'h' => $sizeInfo['bottomContent']['h'], 'mt' => $sizeInfo['bottomContent']['mt'], 'fontSuo' => $sizeInfo['fontSuo']);//文字
                return $imgHelper->mergeAll($datas, null, $sizeInfo['margin']);
                break;
            case self::PRINTTYPE_WORDAD://小广告
                $botImg = $backData['bottom_img'];
                $otherV = $botImg;
                $imgType = 1;
                //合并
                $datas = array();
                $datas[] = array('v' => $img, 'w' => $sizeInfo['w'], 'h' => $sizeInfo['h'] - $sizeInfo['bottomContent']['h'] - $sizeInfo['bottomContent']['mt'], 'cutT' => 2);
                if (!empty($word))
                    $datas[] = array('v' => $word, 'ty' => 2, 'l' => 0, 'w' => $sizeInfo['text']['w'], 'h' => $sizeInfo['bottomContent']['h'], 'fontSuo' => $sizeInfo['fontSuo']);
                //依赖第1张图片
                $datas[] = array('v' => $otherV, 'ty' => $imgType, 'w' => $sizeInfo['rightAd']['w'], 'h' => $sizeInfo['rightAd']['h'], 'rely' => 0, 'mt' => $sizeInfo['bottomContent']['mt'], 'l' => $sizeInfo['rightAd']['l'], 'cutT' => 0);
                return $imgHelper->mergeAll($datas, null, $sizeInfo['margin']);

                break;
            case self::PRINTTYPE_AD:
                $botImg = $backData['bottom_img'];
                if (empty($botImg))
                    return $imgHelper->scaling($img, $allowSize);

                $otherV = $botImg;
                $imgType = 1;
                //合并
                $datas = array();
                $datas[] = array('v' => $img, 'w' => $sizeInfo['w'], 'h' => $sizeInfo['h'] - $sizeInfo['bottomContent']['h'] - $sizeInfo['bottomContent']['mt'], 'cutT' => 2);
                //依赖第1张图片
                $datas[] = array('v' => $otherV, 'ty' => $imgType, 'w' => $sizeInfo['ad']['w'], 'h' => $sizeInfo['ad']['h'], 'rely' => 0, 'l' => 0, 'mt' => $sizeInfo['bottomContent']['mt'], 'cutT' => 0);
                return $imgHelper->mergeAll($datas, null, $sizeInfo['margin']);
                break;
        }
        return $imgHelper->scaling($img, $allowSize);
    }

    /**
     * 打印图片
     * @param $params
     */
    public function doPrint($params)
    {
        $apiParams = [
            'open_id' => $params['open_id'],
            'factory' => $params['factory'],
            'img' => $params['print_img'],
            'code' => $params['code'],
            'pin_code' => $params['pin_code'],
        ];
        $this->getResult('print-do', $apiParams);
    }

    protected $printerCache;

    public function init()
    {
        $this->printerCache = new PrinterCache();
    }

    /**
     * 获取设备列表
     * @return mixed
     */
    public function findClientsList($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'factory' => Printer::FACTORY_WEIXINCHUANG,
            'withShop_Temp' => Printer::FACTORY_WEIXINCHUANG,
            'keyword' => isset($params['keyword']) ? $params['keyword'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
        ];
        $this->getResult('printer-clients-list', $apiParams);
    }

    /**
     * 获取设备详细信息
     * @return mixed
     */
    public function getClients($params)
    {
        $type = 'printer-client-get';
        //拿缓存数据
//        $data = $this->printerCache->getCache($params, $type);
//        if ($data !== false) {
//            $this->setResult($data);
//            return true;
//        }
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'factory' => Printer::FACTORY_WEIXINCHUANG,
            'withShop_Temp' => Printer::FACTORY_WEIXINCHUANG,
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult($type, $apiParams);
        //再从新设置缓存
        if (!is_null($this->_data)) {
            $this->printerCache->setCache($params, $type, $this->_data);
        }
    }

    /**
     * 编辑设备
     * @return mixed
     */
    public function editClient($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'factory' => isset($params['factory']) ? $params['factory'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
            'printer_template_id' => isset($params['printer_template_id']) ? $params['printer_template_id'] : null,
            'client_type' => isset($params['client_type']) ? $params['client_type'] : null,
            'print_type' => isset($params['print_type']) ? $params['print_type'] : null,
            'user_limit' => isset($params['user_limit']) ? $params['user_limit'] : null,
            'device_limit' => isset($params['device_limit']) ? $params['device_limit'] : null,
            'bottom_img' => isset($params['bottom_img']) ? $params['bottom_img'] : null,
            'wx_qrcode' => isset($params['wx_qrcode']) ? $params['wx_qrcode'] : null,
            'wx_qrscene' => isset($params['wx_qrscene']) ? $params['wx_qrscene'] : null,
        ];
        //临时处理
        $apiParams['wx_qrscene'] = "1";
        $this->getResult('printer-client-edit', $apiParams);
        return $this->_data;
    }

    /**
     * 获取设备信息
     * @return mixed
     */
    public function getClientInfo($params)
    {
        $type = 'printer-client-info-get';
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'factory' => isset($params['factory']) ? $params['factory'] : null,
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult($type, $apiParams);
        if (!is_null($this->_data)) {
            return $this->_data;
        }
        return null;
    }

    /**
     * 获取设备固定信息
     * @return mixed
     */
    public function getClientsInfo($params)
    {
        $type = 'printer-clients-info';
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'factory' => isset($params['factory']) ? $params['factory'] : null,
        ];
        $this->getResult($type, $apiParams);
        if (!is_null($this->_data)) {
            return $this->_data;
        }
        return null;
    }


    /**
     * 获取回复信息
     * @return mixed
     */
    public function getResponses($params)
    {
        $type = 'printer-responses-get';
        //拿缓存数据
//        $data = $this->printerCache->getCache($params, $type);
//        if ($data !== false) {
//            $this->setResult($data);
//            return true;
//        }
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'factory' => Printer::FACTORY_WEIXINCHUANG,
        ];
        $this->getResult($type, $apiParams);
        //再从新设置缓存
        if (!is_null($this->_data)) {
            $this->printerCache->setCache($params, $type, $this->_data);
        }
    }

    /**
     * 编辑回复信息
     * @return mixed
     */
    public function editResponses($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'factory' => isset($params['factory']) ? $params['factory'] : null,
            'welcome_word' => isset($params['welcome_word']) ? $params['welcome_word'] : null,
            'input_code' => isset($params['input_code']) ? $params['input_code'] : null,
            'input_error' => isset($params['input_error']) ? $params['input_error'] : null,
            'input_img' => isset($params['input_img']) ? $params['input_img'] : null,
            'printing' => isset($params['printing']) ? $params['printing'] : null,
            'app_error' => isset($params['app_error']) ? $params['app_error'] : null,
            'out_msg' => isset($params['out_msg']) ? $params['out_msg'] : null,
            'user_limit_msg' => isset($params['user_limit_msg']) ? $params['user_limit_msg'] : null,
            'device_limit_msg' => isset($params['device_limit_msg']) ? $params['device_limit_msg'] : null,
        ];
        $this->getResult('printer-responses-edit', $apiParams);
        return $this->_data;
    }

    /**
     * 获取数据库中键的回复设置
     * @param $params
     * @return null
     */
    public function getKeyResponse($params)
    {
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'factory' => isset($params['factory']) ? $params['factory'] : null,
            'key' => isset($params['key']) ? $params['key'] : null,
        ];
        $this->getResult('printer-response-value-get', $apiParams);
        return $this->_data;
    }

    public function getPrinterResponseTip($params)
    {
        $key = $params['key'];
        $tips = '';
        switch ($key) {
            case PrinterList::STATUS_INPUTCUT://说明是裁剪对应的提取语，需特殊处理
                $tips = '是否需要裁剪？<a href="' . $params['cut_url'] . '">裁剪</a> ,否则回复“#”表示不裁剪。';
                break;
            case PrinterList::STATUS_INPUTWRITE:
                $tips = PrinterList::MSGTIP_INPUTWRITE;
                break;
            case PrinterList::STATUS_FAILT1:
                $tips = '数据查询失败';
                break;
            case PrinterList::STATUS_FAILT2:
                $tips = '更改状态失败';
                break;
            case PrinterList::STATUS_SAVESTATEFAILT:
                $tips = '裁剪修改状态失败';
                break;
            case PrinterList::STATUS_SAVWWORDFAIL:
                $tips = '保存文字失败';
                break;
            default:
                $tips = $this->getKeyResponse($params);
                break;
        }

        return $tips;
    }

    /**
     * 设备列表广告设置，设备绑定模板
     * @param $params
     */
    public function bindTemplate($params){
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'id' => isset($params['client_id']) ? $params['client_id'] : null,
            'printer_template_id' => isset($params['printer_template_id']) ? $params['printer_template_id'] : null,
        ];
        $this->getResult('printer-client-bind-template', $apiParams);
    }

    /**
     * 获取素材列表
     * @return mixed
     */
    public function findMaterialsList($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'factory' => Printer::FACTORY_WEIXINCHUANG,
            'title' => isset($params['keyword']) ? $params['keyword'] : null,
            'material_url' => isset($params['material_url']) ? $params['material_url'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => ['id'=>'desc'],
        ];
        $this->getResult('printer-materials-list', $apiParams);
    }

    /**
     * 获取素材硬件接口ID
     * @return mixed
     */
    public function getMaterialsListId($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'factory' => Printer::FACTORY_WEIXINCHUANG,
            'type' => isset($params['type']) ? $params['type'] : null,
            'material_url' => isset($params['material_url']) ? $params['material_url'] : null,
        ];
        $this->getResult('printer-materials-get-id', $apiParams);
    }

    /**
     * 添加素材
     * @param $params
     */
    public function addMaterials($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'factory' => Printer::FACTORY_WEIXINCHUANG,
            'type' => isset($params['type']) ? $params['type'] : null,
            'title' => isset($params['title']) ? $params['title'] : null,
            'material_url' => isset($params['img']) ? $params['img'] : null,
        ];
        $this->getResult('printer-materials-add', $apiParams);
    }

    /**
     * 删除素材
     * @param $params
     */
    public function delMaterials($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'factory' => Printer::FACTORY_WEIXINCHUANG,
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult('printer-materials-del', $apiParams);
    }


    /**
     * 获取模板列表
     * @return mixed
     */
    public function findTemplatesList($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'factory' => Printer::FACTORY_WEIXINCHUANG,
            'title' => isset($params['keyword']) ? $params['keyword'] : null,
            'type' => isset($params['client_type']) ? $params['client_type'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => ['id'=>'desc'],
        ];
        $this->getResult('printer-templates-list', $apiParams);
    }

    /**
     * 获取模板详情信息
     * @return mixed
     */
    public function getTemplate($params)
    {
        $type = 'printer-template-get';
        //拿缓存数据
//        $data = $this->printerCache->getCache($params, $type);
//        if ($data !== false) {
//            $this->setResult($data);
//            return true;
//        }
        //拿接口数据
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'factory' => Printer::FACTORY_WEIXINCHUANG,
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult($type, $apiParams);
        //再从新设置缓存
        if (!is_null($this->_data)) {
            $this->printerCache->setCache($params, $type, $this->_data);
        }
    }

    /**
     * 添加模板
     * @return mixed
     */
    public function addTemplate($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'factory' => Printer::FACTORY_WEIXINCHUANG,
            'title' => isset($params['title']) ? $params['title'] : null,
            'material_urls' => isset($params['material_urls']) ? $params['material_urls'] : null,
            'material_api_ids' => isset($params['material_api_ids']) ? $params['material_api_ids'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
        ];
        $this->getResult('printer-template-add', $apiParams);
    }

    /**
     * 编辑模板
     * @return mixed
     */
    public function editTemplate($params)
    {
        $apiParams = [
            'id' => isset($params['id']) ? $params['id'] : null,
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'factory' => Printer::FACTORY_WEIXINCHUANG,
            'title' => isset($params['title']) ? $params['title'] : null,
            'material_urls' => isset($params['material_urls']) ? $params['material_urls'] : null,
            'material_api_ids' => isset($params['material_api_ids']) ? $params['material_api_ids'] : null,
            'shop_sub_id' => isset($params['shop_sub_id']) ? $params['shop_sub_id'] : null,
            'type' => isset($params['type']) ? $params['type'] : null,
        ];
        $this->getResult('printer-template-edit', $apiParams);
    }


    /**
     * 删除模板
     * @return mixed
     */
    public function delTemplate($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'factory' => Printer::FACTORY_WEIXINCHUANG,
            'id' => isset($params['id']) ? $params['id'] : null,
        ];
        $this->getResult('printer-template-del', $apiParams);
    }

    /**
     * 获取打印限制值
     * @param $clientId
     * @param $openId
     * @return int
     */
    public function getPrintLimit($clientId, $openId)
    {
        $apiParams = [
            'printer_client_id' => $clientId,
            'open_id' => $openId,
        ];
        $this->getResult('user-print-limit-check', $apiParams);
        $errMsg = $this->getError();
        if (is_null($errMsg)) {
            return self::LIMIT_PRINT_STATUS_SUCC;
        }

        if ($errMsg['errcode'] === self::LIMIT_PRINT_CODE_DEVICE) {
            return self::LIMIT_PRINT_STATUS_DEVICEFAIL;
        } else if ($errMsg['errcode'] === self::LIMIT_PRINT_CODE_USER) {
            return self::LIMIT_PRINT_STATUS_USERFAIL;
        }
        return self::LIMIT_PRINT_STATUS_FAIL;
    }

    /**
     * 同步设备信息
     * @param $pin_code
     * @return bool
     */
    public function syncPrinterClient($pin_code)
    {
        $apiParams = [
            'pin_code' => $pin_code,
        ];
        $this->getResult('printer-clients-sync', $apiParams);
        if (!is_null($this->_data)) {
            return true;
        }
        return false;
    }

    /**
     * 添加统计数
     * @param $params
     * @return bool
     */
    public function addPrintStatis($params)
    {
        $apiParams = [
            'printer_client_id' => $params['printer_client_id'],
            's_date' => isset($params['s_date']) ? $params['s_date'] : null,
            'free_num' => isset($params['free_num']) ? $params['free_num'] : null,
            'pay_num' => isset($params['pay_num']) ? $params['pay_num'] : null,
            'pay_amount' => isset($params['pay_amount']) ? $params['pay_amount'] : null,
        ];
        $this->getResult('print-to-statistics-add', $apiParams);
        if (!is_null($this->_data)) {
            return true;
        }
        return false;
    }

    /**
     * 获取数据统计列表
     * @return mixed
     */
    public function findStatistics($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'factory' => Printer::FACTORY_WEIXINCHUANG,
            'sortStr' => ['id'=>'desc'],
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
        ];
        $this->getResult('printer-statistics-find', $apiParams);
    }

    /**
     * 获取数据统计总数
     * @return mixed
     */
    public function findStatisticsCount($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'factory' => Printer::FACTORY_WEIXINCHUANG,
            'start' => isset($params['start']) ? $params['start'] : null,
            'end' => isset($params['end']) ? $params['end'] : null,
        ];
        $this->getResult('printer-statistics-count', $apiParams);
    }

    /**
     * 获取设备数据统计列表
     * @return mixed
     */
    public function findStatisticsList($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'factory' => Printer::FACTORY_WEIXINCHUANG,
            'keyword' => isset($params['keyword']) ? $params['keyword'] : null,
            's_date' => isset($params['s_date']) ? $params['s_date'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
        ];
        $this->getResult('printer-statistics-list-find', $apiParams);
    }

    /**
     * 获取设备数据统计详细信息
     * @return mixed
     */
    public function findStatisticsDetail($params)
    {
        $apiParams = [
            'shop_id' => isset($params['shop_id']) ? $params['shop_id'] : null,
            'factory' => Printer::FACTORY_WEIXINCHUANG,
            'printer_client_id' => isset($params['id']) ? $params['id'] : null,
            'page' => isset($params['page']) ? $params['page'] : null,
            'count' => isset($params['count']) ? $params['count'] : null,
            'sortStr' => ['id'=>'desc'],
        ];
        $this->getResult('printer-statistics-detail-find', $apiParams);
    }

}