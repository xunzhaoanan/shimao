<?php

return [
    'id' => 'app-admin',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'admin\controllers',
    'bootstrap' => ['log'],
    'defaultRoute' => 'shop/index',
    'modules' => [],
    'language' => 'zh-CN',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '4JPLXWzZG5fMhe-dkrgC07JLwHuoreIW',
        ],
        'user' => [
            'identityClass' => 'admin\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
            'errorView' => '@yii/views/errorHandler/error.php',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // 'admin/<controller:[\w-]+>/<action:[\w-]+>' => '<controller>/<action>',  //添加 admin 前缀
            ]
        ],
        'i18n' => [
            'translations' => [
                'admin*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@admin/messages',
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
