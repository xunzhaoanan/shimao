<?php

return [
    'id' => 'app-weixin',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'weixin\controllers',
    'bootstrap' => ['log'],
    'defaultRoute' => 'site/index',
    'modules' => [],
    'language' => 'zh-CN',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '4JPLXWzZG5fMhe-dkrgC07JLwHuoreIW',
        ],
        'user' => [
            'identityClass' => 'weixin\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'sitr/error',
            'errorView' => '@yii/views/errorHandler/error.php',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // 'weixin/<controller:[\w-]+>/<action:[\w-]+>' => '<controller>/<action>',  //添加 weixin 前缀
            ]
        ],
        'i18n' => [
            'translations' => [
                'weixin*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@weixin/messages',
                    'fileMap' =>[
                        'exception' => 'exception.php',
                    ],
                ],
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                ],
            ],
        ],
    ],
];
