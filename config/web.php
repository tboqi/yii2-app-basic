<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            // 'layout' => 'left-menu',
            'menus' => [
                // 'assignment' => [
                //     'label' => 'Grant Access', // change label
                // ],
                // 'route' => null, // disable menu
            ],
            'mainLayout' => '@app/views/layouts/main.php',
        ],
        'blogbackend' => [
            'class' => 'funson86\blog\Module',
            'controllerNamespace' => 'funson86\blog\controllers\backend',
        ],
        'blogfrontend' => [
            'class' => 'funson86\blog\Module',
            'controllerNamespace' => 'funson86\blog\controllers\frontend',
        ],
    ],
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'cookieValidationKeycookieValidationKeycookieValidationKey',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'mdm\admin\models\User',
            'loginUrl' => ['admin/user/login'],
            // 'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
        'formatter' => [ //for the showing of date datetime
            'dateFormat' => 'yyyy-MM-dd',
            'datetimeFormat' => 'yyyy-MM-dd HH:mm:ss',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'CNY',
        ],
    ],
    'params' => $params,
    // 'as access' => [
    //     'class' => 'mdm\admin\components\AccessControl',
    //     'allowActions' => [
    //         'site/*',
    //         // 'admin/*',
    //         // 'some-controller/some-action',
    //         // The actions listed here will be allowed to everyone including guests.
    //         // So, 'admin/*' should not appear here in the production, of course.
    //         // But in the earlier stages of your development, you may probably want to
    //         // add a lot of actions here until you finally completed setting up rbac,
    //         // otherwise you may not even take a first step.
    //     ],
    // ],
    'language' => 'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'defaultRoute' => 'blog',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
