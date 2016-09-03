<?php  
$params = array_merge(  
    require(__DIR__ . '/../../common/config/params.php'),  
    require(__DIR__ . '/../../common/config/params-local.php'),  
    require(__DIR__ . '/params.php'),  
    require(__DIR__ . '/params-local.php')  
);  
  
return [  
    'id' => 'app-api',  
    'basePath' => dirname(__DIR__),  
    'bootstrap' => ['log'],  
    'modules' => [  // 添加模块v1和v2，分别表示不同的版本  
        'v1' => [  
            'class' => 'api\modules\v1\Module'  
        ],  
        'v2' => [  
            'class' => 'api\modules\v2\Module'  
        ]  
    ],
    'controllerNamespace' => 'api\controllers',
    'components' => [  
        'user' => [  
            'identityClass' => 'common\models\User',  
            'enableAutoLogin' => false, // API change to false  
            'enableSession' => false,  // API ++  
            'loginUrl' => null // API ++  
        ],  
        'log' => [  
            'traceLevel' => YII_DEBUG ? 3 : 0,  
            'targets' => [  
                [  
                    'class' => 'yii\log\FileTarget',  
                    'levels' => ['error', 'warning'],  
                ],  
            ],  
        ],  
        'errorHandler' => [  
            'errorAction' => 'site/error',  
        ],  
        'urlManager' => [  
        // 'urlFormat' => 'path',  
            'enablePrettyUrl' => true, // 启用美化URL  
            // 'enableStrictParsing' => true, // 是否执行严格的url解析  
            'showScriptName' => false, // 在URL路径中是否显示脚本入口文件  
            'rules' => [  
               '<module>/<controller>/<action>' => '<module>/<controller>/<action>',
            ]  
        ],  
        'i18n' => [
            'translations' => [
                'exception*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en',
                    'fileMap' => [
                        'exception' => 'exception.php',
                    ],
                ],
            ],
        ],
    ],  
    'params' => $params,  
    'language' => 'zh-CN',  


];  