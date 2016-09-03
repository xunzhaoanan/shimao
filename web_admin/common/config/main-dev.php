<?php

return [
    'components' => [
        'cache' => [
            'class' => 'yii\caching\MemCache',
            'servers' => [
                [
                    'host' => '10.100.200.15',
                    'port' => 11211,
                    'weight' => 100,
                ]
            ],
        ],
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://newwsh:newwsh@10.100.200.20:27017/wsh',
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
                    'levels' => ['info'],
                    'categories' => ['wechat']
                ],
            ]
        ],
    ],
    'params' => [
        'AsyncLog.url' => '10.100.200.15',
        'AsyncLog.port' => '9501',
        'AsyncLog.collection' => 'log_front',
        'AsyncVisoter.url' => '10.100.200.15',
        'AsyncVisoter.port' => '9501',
        'AsyncVisoter.collection' => 'log_visitor',
    ],
];
