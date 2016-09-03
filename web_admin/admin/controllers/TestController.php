<?php
/**
 * Author: ZhangP
 * Date: 2016/09/02
 * Time: 09:40
 */

namespace admin\controllers;

use common\forms\test\TestForm;
use common\models\Test;
use Yii;
use yii\web\Controller;

class TestController extends TestBaseController {

	protected $testModel;

	function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function init()
    {
        $this->testModel = new Test();
    }

    /**
     * 测试方法
     */
    public function actionGetAjax()
    {
        if (!Yii::$app->request->isPost) {
            return $this->setError();
        }
        $form = new TestForm();

        if (!$form->load(["TestForm" => Yii::$app->request->post()]) || !$form->validate()) {
            exit('{"errcode":"-3","errmsg":' . json_encode('您提交的数据有误') . '}');
        }

        $serviceParams = $form->toArray();

        $this->testModel->test($serviceParams);
        if (!is_null($this->testModel->getError())) {
            return $this->setError($this->testModel->getError());
        }
        $this->setResult($this->testModel->_data);
    }
}
