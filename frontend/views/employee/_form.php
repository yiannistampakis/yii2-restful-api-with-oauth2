<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'EMP_FirstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMP_LastName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMP_FatherFirstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMP_AFM')->textInput() ?>

    <?= $form->field($model, 'EMP_Email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
