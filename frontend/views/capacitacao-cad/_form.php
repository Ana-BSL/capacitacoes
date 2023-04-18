<?php

use common\helpers\RenderWidget;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CapacitacaoCad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="capacitacao-cad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput() ?>

    <?= $form->field($model, 'descricao')->textarea(['rows' => 3, 'style' => 'resize:none;']) ?>


    <div class="row">

        <div class="col-sm-6">
            <?= $form->field($model, 'carga_horaria')->textInput(['type' => 'number', 'min' => 0]) ?>
        </div>

        <div class="col-sm-6">
            <?= $form->field($model, 'data_realizacao')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'Insira o horário do evento ...'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd/mm/yyyy H:ii',
                ]
            ]); ?>
        </div>

    </div>

    <?= RenderWidget::selectUnidade($form, [
        'model' => $model,
        'attribute' => 'cnes_unidade',
        'data' => $unidades,
    ]); ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>