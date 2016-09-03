<?php

$main = [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Asia/Shanghai',  //时区设置
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                    'logFile' => '@app/runtime/logs/error.log',
                    'maxFileSize' => 1024 * 10,
                    'maxLogFiles' => 50,
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['warning'],
                    'logFile' => '@app/runtime/logs/warning.log',
                    'maxFileSize' => 1024 * 10,
                    'maxLogFiles' => 50,
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                    'categories' => ['wxpay'],
                    'logFile' => '@app/runtime/logs/weixin/wxpay.log',
                    'maxFileSize' => 1024 * 10,
                    'maxLogFiles' => 50,
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                    'categories' => ['wxapi'],
                    'logFile' => '@app/runtime/logs/weixin/wxapi.log',
                    'maxFileSize' => 1024 * 10,
                    'maxLogFiles' => 50,
                ],
				[ 
					'class' => 'yii\log\FileTarget',
					'levels' => [ 
								'info' 
								],
					'categories' => [ 
								'http-send' 
								],
					'logFile' => '@app/runtime/logs/flows.log',
					'maxFileSize' => 1024 * 100,
					'maxLogFiles' => 1024,
					'logVars' => [ ] 
				],
				[
				'class' => 'yii\log\FileTarget',
				'levels' => ['info','error','warning'],
				        'categories' => ['sms_tenpay'],
				                'logFile' => '@app/runtime/logs/sms_tenpay.log',
				                'maxFileSize' => 1024 * 100,
				                'maxLogFiles' => 1024,
				                'logVars' => [ ]
				                ],
            ]
        ],
        'request' => [
            'cookieValidationKey' => '4JPLXWzZG5fMhe-dkrgC07JLwHuoreIW',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
    ],
];

$config =  yii\helpers\ArrayHelper::merge(
    $main,
    require(__DIR__ . '/main-'.CODE_RUNTIME.'.php')
);

defined("CODE_RUNTIME_ONLINE") OR define("CODE_RUNTIME_ONLINE","online");

if (WSH_DEBUG && CODE_RUNTIME != CODE_RUNTIME_ONLINE) {
    //开启调式工具
//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] = [
//        'class' => 'yii\debug\Module',
//        'allowedIPs' => ['*','::1']
//    ];
}

return $config;
