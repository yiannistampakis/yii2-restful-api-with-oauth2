<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PER_FirstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PER_LastName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PER_FatherFirstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PER_AFM')->textInput() ?>

    <?= $form->field($model, 'PER_Email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
