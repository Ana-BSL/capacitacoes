<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\CapacitacaoCad */

?>
<div class="capacitacao-cad-create">
    <?= $this->render('_form', [
        'model' => $model,
        'unidades' => $unidades 
    ]) ?>
</div>
