<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Scoutparent */

$this->title = 'Create Scoutparent';
$this->params['breadcrumbs'][] = ['label' => 'Scoutparents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scoutparent-create">

    <h1>Parent Information:</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
