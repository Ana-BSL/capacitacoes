<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\CapacitacaoEspec */

?>
<div class="capacitacao-espec-create">
    <?= $this->render('_form', [
        'model' => $model,
        'unidades' => $unidades 

    ]) ?>
</div>
