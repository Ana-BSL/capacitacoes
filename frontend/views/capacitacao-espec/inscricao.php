<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="capacitacao-espec-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cpf')->widget(\yii\widgets\MaskedInput::class, [
        'mask' => '999.999.999-99',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Verificar CPF', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>