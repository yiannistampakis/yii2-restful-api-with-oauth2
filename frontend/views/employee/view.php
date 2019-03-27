<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = $model->EMP_LastName . ' ' . $model->EMP_FirstName;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->EMP_Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->EMP_Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Είστε σίγουροι ότι θέλετε να γίνει η διαγραφή;',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'EMP_Id',
            'EMP_FirstName',
            'EMP_LastName',
            'EMP_FatherFirstName',
            'EMP_AFM',
            'EMP_Email:email', 
        ],
    ]) ?>

</div>
