<?php  
namespace api\modules\v1\controllers;  
use api\controllers\SiteController;  
use yii\web\Controller;  
class HelloController extends SiteController
{  
    public function actionIndex()  
    {  
    	echo "asd";die;
       // \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;  
       // return [  
       //     'message' => 'API test Ok!',  
       //     'code' => 100,  
       // ];  
    }  
}  