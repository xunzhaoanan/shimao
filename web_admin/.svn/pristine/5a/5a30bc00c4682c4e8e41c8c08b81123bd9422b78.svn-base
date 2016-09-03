<?php

return [
    'components' => [
        'cache' => [
            'class' => 'yii\caching\MemCache',
            'servers' => [
                [
                    'host' => '10.66.137.35',
                    'port' => 9101,
                    'weight' => 100,
                ]
            ],
            'keyPrefix' => PROJECTKEY,
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=10.104.155.141;port=3306;dbname=jianingnasp',
            'username' => 'jianingnasp',
            'password' => 'jianingnasp@123.com',
            'charset' => 'utf8',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'common\vendor\log\AsyncTarget',
                    'levels' => ['error'],
                ],
                [
                    'class' => 'common\vendor\log\AsyncTarget',
                    'levels' => ['warning'],
                ],
                [
                    'class' => 'common\vendor\log\AsyncTarget',
                    'levels' => ['info'],
                    'categories' => ['wxpay']
                ],
                [
                    'class' => 'common\vendor\log\AsyncTarget',
                    'levels' => ['info'],
                    'categories' => ['wxapi']
                ],
                [
                    'class' => 'common\vendor\log\AsyncTarget',
                    'levels' => ['info'],
                    'categories' => ['ParamsIn']
                ],
                [
                    'class' => 'common\vendor\log\AsyncTarget',
                    'levels' => ['error'],
                    'categories' => ['wechat']
                ],
                [
                    'class' => 'common\vendor\log\AsyncTarget',
                    'levels' => ['info'],
                    'categories' => ['jianingnasp']
                ],
            ]
        ],
    ],
    'params' => [
        'AsyncLog.url' => '10.104.147.132',
        'AsyncLog.port' => '9501',
        'AsyncLog.collection' => 'dkhv2_log_front',
        'AsyncVisoter.url' => '10.104.147.132',
        'AsyncVisoter.port' => '9501',
        'AsyncVisoter.collection' => 'dkhv2_log_visitor',   
    ],
];
