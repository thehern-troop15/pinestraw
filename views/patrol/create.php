<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Patrol */

$this->title = 'Create Patrol';
$this->params['breadcrumbs'][] = ['label' => 'Patrols', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patrol-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
