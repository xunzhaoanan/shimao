<?php
/**
 * Author: MaChenghang
 * Date: 2015/06/13
 * Time: 14:19
 */

namespace admin\controllers;

use common\cache\Session;
use common\vendor\captcha\CaptchaLib;
use Yii;
use yii\base\Controller;


class CaptchaController extends Controller
{

    /**
     * 生成验证码图片
     */
    public function actionGetimage(){
        $captcha = new CaptchaLib();
        //输出验证码
        $captcha->getImage();
    }


}