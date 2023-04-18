<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\CapacitacaoRel */
?>
<div class="capacitacao-rel-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_espectador',
            'id_capacitacao',
            'id',
        ],
    ]) ?>

</div>
