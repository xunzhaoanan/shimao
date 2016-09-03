<?php

// return [
//     'components' => [
//         'cache' => [
//             'class' => 'yii\caching\MemCache',
//             'servers' => [
//                 [
//                     'host' => '10.100.100.35',
//                     'port' => 11211,
//                     'weight' => 100,
//                 ]
//             ],
//             'keyPrefix' => WEIXINID,
//         ],
//         'db' => [
//             'class' => 'yii\db\Connection',
//             'dsn' => 'mysql:host=10.100.100.35;port=3306;dbname=dkh_newzds',
//             'username' => 'root',
//             'password' => '123456',
//             'charset' => 'utf8',
//         ],
//     ],
//     'params' => [
//     ],
// ];



return [
    'components' => [
         'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=10.100.100.35;port=3306;dbname=dkh_jianingnasp',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
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

