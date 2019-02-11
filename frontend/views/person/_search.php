<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PersonSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'PER_Id') ?>

    <?= $form->field($model, 'PER_FirstName') ?>

    <?= $form->field($model, 'PER_LastName') ?>

    <?= $form->field($model, 'PER_FatherFirstName') ?>

    <?= $form->field($model, 'PER_AFM') ?>

    <?= $form->field($model, 'PER_Email') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
