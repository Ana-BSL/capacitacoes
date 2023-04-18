<?php

use common\helpers\RenderWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CapacitacaoEspec */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="capacitacao-espec-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'cpf')->widget(\yii\widgets\MaskedInput::class, [
                'mask' => '999.999.999-99',
            ]) ?>
        </div>

        <div class="col-sm-6">
            <?= $form->field($model, 'telefone')->widget(\yii\widgets\MaskedInput::class, [
                'mask' => ['(99) 9999-9999', '(99) 99999-9999'],
            ]) ?>
        </div>

    </div>

    <?= RenderWidget::selectUnidade($form, [
        'model' => $model,
        'attribute' => 'id_unidade',
        'data' => $unidades,
    ]); ?>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>