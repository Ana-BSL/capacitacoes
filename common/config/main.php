<?php
return [
    'name' => 'CAPACITAÇÕES',
    'sourceLanguage' => 'pt-BR',
    'language' => 'pt-BR',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => [
        //'\common\modules\dektrium\user\Bootstrap',
        //'\common\modules\johnitvn\rbacplus\src\Bootstrap',
    ],
    'aliases' => [
        '@bower' =>
        '@vendor/bower-asset'


    ],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                ],
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => "skin-green",
                ],
                'kartik\date\DatePickerAsset' => [
                    'depends' => [
                        'yii\web\JqueryAsset',
                        'kartik\daterange\MomentAsset',
                        'kartik\sortable\SortableAsset',
                    ],
                ],
            ],
        ],
        
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
        ],
        'urlManagerFrontend' => [
            'baseUrl' => str_replace('/backend/web', '/frontend/web', (new \yii\web\Request)->getBaseUrl()),
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'urlManagerBackend' => [
            'baseUrl' => str_replace('/frontend/web', '/backend/web', (new \yii\web\Request)->getBaseUrl()),
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'enablePasswordRecovery' => true,
            //'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['pires', 'admin'],
            'mailer' => [
                'sender'                => 'juniorpiresupe@gmail.com', // or ['no-reply@myhost.com' => 'Sender name']
                'welcomeSubject'        => 'Welcome subject',
                'confirmationSubject'   => 'Confirmation subject',
                'reconfirmationSubject' => 'Email change subject',
                'recoverySubject'       => 'Recovery subject',
            ],
        ],
        'rbac' =>  [
            'class' => 'johnitvn\rbacplus\Module'
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
    ],
];
