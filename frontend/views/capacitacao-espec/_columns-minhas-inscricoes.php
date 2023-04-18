<?php

use yii\helpers\Html;
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
        'template' => '{view}',
        'buttons' => [
        ],
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Update', 'data-toggle' => 'tooltip'],
    ],

];
