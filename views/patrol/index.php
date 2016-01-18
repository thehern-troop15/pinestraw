<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PatrolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patrols';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patrol-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Patrol', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            ['attribute' => 'name', 'header'=> 'Patrol Name'],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
