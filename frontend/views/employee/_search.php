<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EmployeeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'EMP_Id') ?>

    <?= $form->field($model, 'EMP_FirstName') ?>

    <?= $form->field($model, 'EMP_LastName') ?>

    <?= $form->field($model, 'EMP_FatherFirstName') ?>

    <?= $form->field($model, 'EMP_AFM') ?>

    <?= $form->field($model, 'EMP_Email') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
