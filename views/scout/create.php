<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Scout */

$this->title = 'Create Scout';
$this->params['breadcrumbs'][] = ['label' => 'Scouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scout-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'where' => $where,
    ]) ?>

</div>
