<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\CapacitacaoEspec */
?>
<div class="capacitacao-espec-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_espectador',
            'nome',
            'cpf',
            'email:email',
            [
                'attribute' => 'cnes_unidade',
                'value' => $model->unidade->nome,
            ],
            'telefone',
        ],
    ]) ?>

</div>
