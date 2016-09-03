<?php
/**
 * Author: Liuping
 * Date: 2015/7/1
 * Time: 20:05
 * 活动公共类
 */

namespace admin\controllers;

use common\forms\activity\QrcodeForm;
use common\models\Shop;
use common\models\Terminal;
use common\services\activity\ActivityService;
use common\services\base\ShopService;
use Yii;


class ActivityController extends BaseController
{

    protected $activityService;
    protected $terminalModel;

    function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->activityService = new ActivityService();
        $this->terminalModel = new Terminal();
    }

    /*
     * 添加活动
     */
    public function actionAdd()
    {
        return $this->render('add', []);
    }

    /*
     * 修改活动
     */
    public function actionEdit()
    {

        return $this->render('edit', []);
    }


    /*
     * 活动二维码列表
     */
    public function actionQrcode(){
        // form处理
        $form = new QrcodeForm();
        $this->checkForm(["QrcodeForm"=>Yii::$app->request->get()],$form);
        $qrcode = $this->handleForm($form);
        return $this->render('qrcode', ['qrcode'=>['model'=>$qrcode['model'],'model_id'=>$qrcode['model_id']]]);
    }

    /*
     * 活动二维码列表
     */
    public function actionQrcodeAjax(){
        if( ! Yii::$app->request->isPost ) {
            return $this->setError();
        }
        $serviceParams = ['shop_id' => $this->_shop['id']];
        $this->getPageInfo($serviceParams);
        // 把商家店铺都拿出来
        $this->terminalModel->find($serviceParams);
        // 接收逻辑层处理结果
        if ( ! is_null($this->terminalModel->getError())){
            return $this->setError($this->terminalModel->getError());
        }
        //如果是第一页，把商家也放入二维码列表里
        //pr(1);

        if($serviceParams['page'] < 1){
            $a = ['id'=>0,'shopInfo' => ['name'=>'无参数二维码']];
            array_unshift($this->terminalModel->_data['data'],$a);
//            $this->terminalModel->_data['data'][] = [
//                'id'=>0,'shopInfo' => ['name'=>$this->_shop['name']]
//            ];
        }
       // pr($this->terminalModel->_data);
        $this->setResult($this->terminalModel->_data);
    }
}