<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Scoutparent */

$this->title = 'Update Scoutparent: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Scoutparents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="scoutparent-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
