<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ScoutrelationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scoutrelations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scoutrelation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Link to a Scout', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'scout.name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
