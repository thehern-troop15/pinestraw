<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Scoutrelation */

$this->title = 'Create Scoutrelation';
$this->params['breadcrumbs'][] = ['label' => 'Scoutrelations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scoutrelation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
