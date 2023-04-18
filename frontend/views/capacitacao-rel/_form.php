<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CapacitacaoRel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="capacitacao-rel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_espectador')->textInput() ?>

    <?= $form->field($model, 'id_capacitacao')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
