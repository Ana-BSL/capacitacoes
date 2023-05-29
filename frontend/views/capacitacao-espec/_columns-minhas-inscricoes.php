<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\CapacitacaoCad;
use app\models\CapacitacaoEspec;
use app\models\CapacitacaoRel;
use app\models\UnidadeSaude;

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
    /*
    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{certificado} {view}',
        'buttons' => [
            'certificado' => function ($url, $model, $key) use ($nome, $data, $cargaHoraria, $titulo, $unidade) {

                $nome = $model->nome;
                $data = $model->data;
                $cargaHoraria = $model->cargaHoraria;
                $titulo = $model->titulo;
                $unidade = $model->unidade;
            //'certificado' => function ($url, $model, $key) { 
                //return Html::a('<span class="glyphicon glyphicon-print"></span>', ['certificado', 'id' => $key, 'pdf' => true], [
                    return Html::a('<span class="glyphicon glyphicon-print"></span>', array_merge(['certificado', 'id' => $key, 'pdf' => true, 'nome' => $nome, 'data' => $data, 'cargaHoraria' => $cargaHoraria, 'titulo' => $titulo, 'unidade' => $unidade]), [
                    'title' => Yii::t('app', 'Gerar Certificado'),
                    'data-pjax' => '0',
                    'target' => '_blank'
                ]);
            }
        ],
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key) {
            if ($action === 'certificado') {
                //return Url::to(['certificado', 'id' => $key, 'pdf' => true]);
                return Url::to(array_merge(['certificado', 'id' => $key, 'pdf' => true], Yii::$app->request->get()));
            }
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Update', 'data-toggle' => 'tooltip'],
       
    ],

    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{certificado} {view}',
        'buttons' => [
            'certificado' => function ($url, $model, $key) use ($nome, $data, $titulo,$cargaHoraria, $unidade) {
                $certificados = $model->getCertificados(); // Obter a lista de certificados para o modelo atual
                
                $buttons = '';
                foreach ($certificados as $certificado) {
                    $buttons .= Html::a('<span class="glyphicon glyphicon-print"></span>', array_merge(['certificado', 'id' => $key, 'pdf' => true, 'nome' => $nome, 'data' => $data, 'cargaHoraria' => $cargaHoraria, 'titulo' => $titulo, 'unidade' => $unidade], $certificado), [
                        'title' => Yii::t('app', 'Gerar Certificado'),
                        'data-pjax' => '0',
                        'target' => '_blank'
                    ]);
                }
                
                return $buttons;
            }
        ],
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key) {
            if ($action === 'certificado') {
                return Url::to(array_merge(['certificado', 'id' => $key, 'pdf' => true], Yii::$app->request->get()));
            }
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Update', 'data-toggle' => 'tooltip'],       
    ],
*/
   /* [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{certificado} {view}',
        'buttons' => [
            'certificado' => function ($url, $model, $key) { 
                return Html::a('<span class="glyphicon glyphicon-print"></span>', ['certificado', 'id' => $model->id, 'pdf' => true], [
                    'title' => Yii::t('app', 'Gerar Certificado'),
                    'data-pjax' => '0',
                    'target' => '_blank'
                ]);
            }
        ],
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key) {
            return Url::to([$action, 'id' => $model->id]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Update', 'data-toggle' => 'tooltip'],
    
    ],*/

    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{certificado} {view}',
        'buttons' => [
            'certificado' => function ($url, $model, $key) use ($id) {
                return Html::a('<span class="glyphicon glyphicon-print"></span>', Url::to(['/capacitacao-espec/certificado', 'id' => $id, 'pdf' => true]), [
                    'title' => Yii::t('app', 'Gerar Certificado'),
                    'data-pjax' => '0',
                    'target' => '_blank'
                ]);
            }
        ],
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key) {
            if ($action === 'certificado') {
                return Url::to(['certificado', 'id' => $key]);
            }
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Update', 'data-toggle' => 'tooltip'],
       
    ],


];
