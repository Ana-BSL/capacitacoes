<?php

use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id_capacitacao',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'titulo',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'descricao',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'carga_horaria',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'data_realizacao',
        'format' => ['datetime', 'php:d/m/Y H:i'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'cnes_unidade',
        'value' => 'unidade.nome',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Update', 'data-toggle' => 'tooltip'],
        'deleteOptions' => [
            'role' => 'modal-remote', 'title' => 'Delete',
            'data-confirm' => false, 'data-method' => false, // for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => 'Você tem certeza?',
            'data-confirm-message' => 'Você tem certeza que desejar apagar este(s) cadastro(s)'
        ],
    ],

];
