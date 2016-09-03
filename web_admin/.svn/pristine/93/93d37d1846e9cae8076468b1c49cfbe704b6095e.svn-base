<?php

return [
    'components' => [
        'cache' => [
            'class' => 'yii\caching\MemCache',
            'servers' => [
                [
                    'host' => '10.104.177.231',
                    'port' => 9101,
                    'weight' => 100,
                ]
            ],
        ],
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://wsh:wsh123.com@10.66.136.231:27017/wsh',
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
            ]
        ],
    ],
    'params' => [
        'AsyncLog.url' => '10.104.147.132',
        'AsyncLog.port' => '9501',
        'AsyncLog.collection' => 'log_front',
        'AsyncVisoter.url' => '10.104.147.132',
        'AsyncVisoter.port' => '9501',
        'AsyncVisoter.collection' => 'log_visitor',
    ],
];
