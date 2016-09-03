<?php
namespace admin\controllers;

use common\cache\Session;
use common\forms\login\LoginForm;
use common\forms\login\QqLoginForm;
use common\models\Login;
use common\models\Shop;
use common\services\login\LoginService;
use Yii;
use yii\web\Controller;


class LoginController extends Controller
{

    //不校验前端 csrf 攻击
    public $enableCsrfValidation = false;

    function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function beforeAction($action)
    {
        parent::beforeAction($action);
        Yii::info(['url' => Yii::$app->request->url, 'params' => json_decode(Yii::$app->request->rawBody, true)], 'ParamsIn');
        return true;
    }


    /**
     * qq登陆页面
     */
    public function actionQqLogin()
    {
        $form = new QqLoginForm();
        if (!$form->load(["QqLoginForm" => Yii::$app->request->get()]) || !$form->validate()) {
            exit('you do not have access to login .');
        }
        $serviceParams = $form->toArray();
        // 调用逻辑层
        $loginServer = new LoginService();
        $data = $loginServer->managerLogin($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($loginServer->getError())) {
            header('Location: /login/error?errmsg='.$loginServer->getError()['errmsg']);
            exit;
        } else {
            $url = '/shop/index';
            if ($data['shop']['is_restaurant'] == Shop::IS_RESTAURANT_YES && isset($data['shop']['catering_url']) && $data['shop']['catering_url']) {
                $url = $data['shop']['catering_url'];
            }
        }
        header('Location: ' . $url);
        exit;
    }

    /**
     * 普通登陆页面
     */
    public function actionError()
    {
        return $this->renderPartial('error');
    }

    /**
     * 普通登陆页面
     */
    public function actionIndex()
    {
        return $this->renderPartial('index');
    }

    /**
     * 普通登陆接口
     */
    public function actionLoginAjax()
    {
        $captcha = Session::get(Session::SESSION_KEY_CAPTCHA);
        Session::del(Session::SESSION_KEY_CAPTCHA);
        if (!Yii::$app->request->isPost) {
            exit('{"errcode":"-3","errmsg":' . json_encode('page not found') . '}');
        }
        $form = new LoginForm();
        if (!$form->load(["LoginForm" => Yii::$app->request->post()]) || !$form->validate()) {
            exit('{"errcode":"-3","errmsg":' . json_encode('您提交的数据有误') . '}');
        }
        $serviceParams = $form->toArray();
        //验证验证码
        if (strtolower($serviceParams['captcha']) != $captcha) {
            //测试阶段，去除验证码验证
            exit('{"errcode":"-3","errmsg":' . json_encode('验证码有误') . '}');
        }
        // 调用逻辑层
        $loginServer = new LoginService();
        $data = $loginServer->managerLogin($serviceParams);
        // 接收逻辑层处理结果
        if (!is_null($loginServer->getError())) {
            exit(json_encode($loginServer->getError()));
        }
        if ($data['shop']['is_restaurant'] == 1 && isset($data['shop']['catering_url']) && $data['shop']['catering_url']) {
            exit('{"errcode":"200","errmsg":' . json_encode($data['shop']['catering_url']) . '}');
        }
        exit('{"errcode":"0","errmsg":' . json_encode('登陆成功') . '}');
    }

    /**
     * 退出登录
     */
    public function actionLogout()
    {
        Session::clear();
        $this->goLogin();
    }

    /**
     * 跳转到登陆页面
     */
    public function goLogin()
    {
        $host = $_SERVER['HTTP_HOST'];
        //线上环境，并且不是登陆页面
        if (strpos($host, Login::ONLINE_HOST_KEY) && strlen($_SERVER['REQUEST_URI']) > 1) {
            Header('Location: ' . Login::ONLINE_LOGIN_URL);
            exit;
        }
        //测试及开发环境
        Header('Location: /login/index');
        exit;
    }

}
