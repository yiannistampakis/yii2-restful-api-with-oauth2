<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = 'Update Person: ' . $model->PER_LastName . ' ' . $model->PER_FirstName;
$this->params['breadcrumbs'][] = ['label' => 'Persons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PER_FirstName, 'url' => ['view', 'id' => $model->PER_Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="person-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
