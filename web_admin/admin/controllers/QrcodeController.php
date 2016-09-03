<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/10
 * Time: 15:00
 * 商品类
 * 1、商品列表
 * 2、添加商品
 * 3、编辑商品
 */


namespace admin\controllers;
use common\forms\qrcode\ImageForm;
use common\vendor\qrcode\QRcode;
use weixin\forms\GeneralForm;
use Yii;

class QrcodeController extends BaseController
{

    public $qrcodeService;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }


    /*
     * 普通链接二维码
     */
    public function actionImage(){
        // form处理
        $form = new ImageForm();
        $this->checkForm(["ImageForm"=>Yii::$app->request->get()],$form);
        $params = $this->handleForm($form);
        QRcode::png($params['url']);
    }

    /*
     * 下载二维码
     */
    public function actionDown(){
        // form处理
        $form = new ImageForm();
        $this->checkForm(["ImageForm"=>Yii::$app->request->get()],$form);
        $params = $this->handleForm($form);
        ob_clean();
        header('Content-type:image/png');
        $file = QRcode::png($params['url']);
        header("Content-Disposition: attachment; filename='$file'");
        exit();
    }


}