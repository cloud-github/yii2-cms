<?php
use \yii\web\Request;

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$request = new Request();
$baseUrlFront = str_replace('/admin', '', (new Request())->getBaseUrl());
return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [],
    'components' => [
        'i18n' => [
            'translations' => [
                'yii2-cms' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@frontend/messages', // if advanced application, set @frontend/messages
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
            ],
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'identityCookie' => [
                'name' => '_admin',
            ],
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
        ],
        'urlManagerFront' => [
            'class' => 'yii\web\urlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'scriptUrl' => $baseUrlFront,
            'baseUrl' => $baseUrlFront,
        ],
        'urlManagerBack'  => [
            'class' => 'yii\web\urlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager'     => [
            'class' => 'yii\rbac\DbManager',
        ],
    ],
    'params' => $params,
];
