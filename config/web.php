<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
     // behavior
    'on beforeRequest' => function ($event) {
        $l_saved = null;
        if (true){
            # use cookie to store language
            $l_saved = Yii::$app->request->cookies->get('locale');
        }else{
            # use session to store language
            $l_saved = Yii::$app->session['locale'];
        }
        $l = ($l_saved)?$l_saved:'zh-CN';
        echo $l;
        Yii::$app->sourceLanguage = (string)$l;
        Yii::$app->language = $l;
        return; 
    }, 
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'WbGirXTUWAFXTR0vaJag40OmChjJJycn',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
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

    'urlManager' => [
        'class' => 'yii\web\UrlManager',
        'showScriptName' => false,
        'enablePrettyUrl' => true,
        'enableStrictParsing' => false,
        'rules' => [
            ['class' => 'yii\rest\UrlRule', 'controller' => 'authapi'],

        ],
    ],
    // ... andere Einstellungen
    'i18n' => [
            'translations' => [
            'app*' => [
                'class' => 'yii\i18n\GettextMessageSource',
                'basePath' => '@app/messages', // @app zeigt auf Yii2-Base
                // 'sourceLanguage' => 'zh-CN', // Standardsprache der Strings im Projekt
                // 'catalog' => 'zh_CN',//与@app/language/zh-CN/message.po文件名一致
                'useMoFile' => false,
            ],
            ],
        ],
    'log' => [
                'traceLevel' => 0, //YII_DEBUG ? 3 : 0,
                'flushInterval' => 1,   //
                'targets' => [
                    [

                        'class' => 'yii\log\FileTarget',
                        'levels' => ['error', 'warning'],
                        'exportInterval' => 1,
                        'logFile' => '@app/runtime/logs/bb.log',
                        /*
                        'logFile' => '@app/runtime/logs/bb.log',
                        'exportInterval' => 100,
                        'class' => 'yii\log\FileTarget',
                        //'levels' => ['error', 'warning'],
                        'categories' => [
                            'yii\db\*',
                            'yii\web\HttpException:*',
                        ],
                        'except' => [
                            'yii\web\HttpException:404',
                        ],
                        */
                    ],
                     [
                        'class' => 'yii\log\FileTarget',
                        'categories' => ['lucky'],
                        'levels' => ['error'],
                        'logVars' => [],   //!!! disable global variables
                        'logFile' => '@app/runtime/logs/lucky-error.log',
                    ],
                    [
                       'class' => 'yii\log\FileTarget',
                       'categories' => ['lucky'],
                       'levels' => ['warning'],
                       'logVars' => [],   //!!! disable global variables
                       'logFile' => '@app/runtime/logs/lucky-warning.log',
                   ],
                    [
                       'class' => 'yii\log\FileTarget',
                       'categories' => ['lucky'],
                       'levels' => ['trace'],
                       'logVars' => [],   //!!! disable global variables
                       'logFile' => '@app/runtime/logs/lucky-trace.log',
                   ],
                    [
                       'class' => 'yii\log\FileTarget',
                       'categories' => ['money'],
                       'levels' => ['info'],
                       'logVars' => [],   //!!! disable global variables
                       'logFile' => '@app/runtime/logs/money.log',
                   ],
                    [
                        'class' => 'yii\log\FileTarget',
                        'categories' => ['promotion'],
                        'levels' => ['error', 'warning','trace'],
                        'logVars' => [],   //!!! disable global variables
                        'logFile' => '@app/runtime/logs/promotion-data.log',
                    ],
                    [
                        'class' => 'yii\log\FileTarget',
                        'categories' => ['agent'],
                        'levels' => ['error', 'warning','trace'],
                        'logVars' => [],   //!!! disable global variables
                        'logFile' => '@app/runtime/logs/agent-data.log',
                    ],
                ],
            ],
        'db' => require(__DIR__ . '/db.php'),
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
