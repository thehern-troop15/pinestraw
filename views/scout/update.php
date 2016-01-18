<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Scout */

$this->title = 'Update Scout: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Scouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="scout-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'where' => $where,
    ]) ?>

</div>
