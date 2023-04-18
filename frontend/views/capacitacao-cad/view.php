<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\CapacitacaoCad */
?>
<div class="capacitacao-cad-view">

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id_capacitacao',
        'titulo',
        'descricao',
        'carga_horaria',
        [
            'attribute' => 'data_realizacao',
            'value' => function ($model) {
                return (new DateTime($model->data_realizacao))->format('d/m/Y H:i');
            },
        ],
        [
            'attribute' => 'created_by',
            'value' => function ($model) {
                return $model->created_by ? Yii::$app->db->createCommand('SELECT username FROM public."user" WHERE id=:id')->bindValue(':id', $model->created_by)->queryScalar() : null;
            },
        ],
        [
            'attribute' => 'created_at',
            'value' => function ($model) {
                return (new DateTime($model->created_at))->format('d/m/Y H:i:s');
            },
        ],        
        [
            'attribute' => 'updated_by',
            'value' => function ($model) {
                return $model->updated_by ? Yii::$app->db->createCommand('SELECT username FROM public."user" WHERE id=:id')->bindValue(':id', $model->updated_by)->queryScalar() : null;
            },
        ],
        [
            'attribute' => 'updated_at',
            'value' => function ($model) {
                return (new DateTime($model->updated_at))->format('d/m/Y H:i:s');
            },
        ],
        [
            'attribute' => 'cnes_unidade',
            'value' => $model->unidade->nome,
        ],
    ],
]) ?>






</div>