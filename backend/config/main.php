<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        /* 'request' => [
             'csrfParam' => '_csrf-backend',
         ], */
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'response' => [
            // 'class' => yii\web\Response::class,
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
            'on beforeSend' => function ($event) {
                /* @var $response Response */
                $response = $event->sender;
                if ($response->statusCode !== 200 && $response->statusCode !== 302) {
                    
                    // $response->data = [
                    //     'success' => $response->isSuccessful,
                    //     'data' => $response->statusCode
                    // ];
                    
                    // if response is a '400 Bad Request' 
                    // makes the response normal '200' 
                    // and the client catches the error through
                    // error_code field in the json body 
                    if ($response->statusCode == 400) {
                        $response->statusCode = 200;
                        $response->format = yii\web\Response::FORMAT_JSON;
                    }
                }
            },
        ],
        //  'response' => [
        //     'format' => yii\web\Response::FORMAT_JSON,
        //     'charset' => 'UTF-8',
        //     // ...
        // ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '1/register'=>'site/register',
                '1/authorize'=>'site/authorize',
                '1/accesstoken'=>'site/accesstoken',
                '1/me'=>'site/me',
                '1/logout'=>'site/logout',

                // '1/employees'=>'employee/index',
                // '1/employees/view/<id>'=>'employee/view',
                // '1/employees/create'=>'employee/create',
                // '1/employees/update/<id>'=>'employee/update',
                // '1/employees/delete/<id>'=>'employee/delete',

                '1/employees'=>'employee/index',
                '1/employees/view/<id>'=>'employee/view',
                '1/employees/create'=>'employee/create',
                '1/employees/update/<id>'=>'employee/update',
                '1/employees/delete/<id>'=>'employee/delete',
                
                '1/employees/sdap/'=>'employee/sdap',
                '1/employees/sdap/teacher'=>'employee/sdap-teacher',

                // '1/person'=>'person/index',
                // '1/person/view/<id>'=>'person/view',
                // '1/person/create'=>'person/create',
                // '1/person/update/<id>'=>'person/update',
                // '1/person/delete/<id>'=>'person/delete',
                
                // '1/person/sdap/'=>'person/sdap',
                // '1/person/sdap/teacher'=>'person/sdap-teacher',

                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
                // '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
            ],

        ],

        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'employee'],
            ],
        ],
        */


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
