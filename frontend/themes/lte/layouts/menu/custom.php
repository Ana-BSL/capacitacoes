<?php

return [
    ['label' => 'Geral', 'options' => ['class' => 'header']],
    ['label' => 'Capacitações', 'url' => ['/capacitacao-cad'], '' => Yii::$app->user->isGuest],
    ['label' => 'Espectadores', 'url' => ['/capacitacao-espec'], '' => Yii::$app->user->isGuest],
    ['label' => 'Inscrição', 'url' => ['/capacitacao-cad/list'], '' => Yii::$app->user->isGuest],
    ['label' => 'Relações', 'url' => ['/capacitacao-rel'], '' => Yii::$app->user->isGuest],
    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
    ['label' => 'Buscar', 'url' => ['/capacitacao-espec/buscar'], '' => Yii::$app->user->isGuest],
    ['label' => 'Login', 'url' => ['user/login'], '' => Yii::$app->user->isGuest],

];
