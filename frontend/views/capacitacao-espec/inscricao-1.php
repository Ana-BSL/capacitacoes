<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\RenderWidget;

/* @var $this yii\web\View */
/* @var $model app\models\CapacitacaoEspec */
/* @var $unidades array */

$this->title = 'Cadastrar Espectador';
$this->params['breadcrumbs'][] = ['label' => 'Capacitações', 'url' => ['/capacitacao/index']];
$this->params['breadcrumbs'][] = ['label' => 'Capacitação Específica', 'url' => ['/capacitacao-espec/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="capacitacao-espec-create">

    <h1><?= Html::encode($this->title) ?></h1>

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


    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>