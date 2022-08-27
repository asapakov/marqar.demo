<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
	'name' => 'MARKHAR',
    'timeZone' => 'Asia/Almaty',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'language' => 'ru-RU', // язык приложения
    //'catchAll' => ['site/maintenance'], //kbb 30.12.21 22:03
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
       'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                //kbb 06.02.22 5:48
                [
                    'class' => 'yii\log\FileTarget', //в файл
                    'categories' => ['process'], //категория логов
                    'logFile' => '@runtime/logs/process.log', //куда сохранять
                    'logVars' => [] //не добавлять в лог глобальные переменные ($_SERVER, $_SESSION...)
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
//		 'mailer' => [
//            'class' => 'yii\swiftmailer\Mailer',
//        ],
        'robokassa' => [
            'class' => '\robokassa\Merchant',
            'baseUrl' => 'https://auth.robokassa.ru/Merchant/Index.aspx',
            'storeId' => 'markharllp',
            'password1' => 'bbEIx3wO7pLAr7b24KjU',
            'password2' => 'BjvL5yB6WU28FDsWP3VH',
            'isTest' => !YII_ENV_PROD,
        ],
        
    ],
    'params' => $params,
];
