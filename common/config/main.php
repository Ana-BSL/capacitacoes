<?php
return [
    'name'=>'NOME DO SISTEMA',
    'sourceLanguage'=>'pt-BR',
    'language'=>'pt-BR',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap'=>[
        //'\common\modules\dektrium\user\Bootstrap',
        //'\common\modules\johnitvn\rbacplus\src\Bootstrap',
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
                'skin' => "skin-blue",
            ],
        ],
    ], 
       'urlManager' => [
        'class' => 'yii\web\UrlManager',
         'enablePrettyUrl' => true,
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
            'enableUnconfirmedLogin'=>true,
            'enablePasswordRecovery'=>true,
            //'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['pires','admin'],
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
