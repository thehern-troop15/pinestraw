<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
       if (Yii::$app->user->identity->getIsScout()) {
           print GridView::widget([
               'dataProvider' => $dataProvider,
               //'filterModel' => $searchModel,
               'columns' => [
                   ['class' => 'yii\grid\SerialColumn'],
                   'name:ntext',
                   'subdivision:ntext',
                   'house_number:ntext',
                   'street_name:ntext',
                   // 'city:ntext',
                   // 'zip:ntext',
                   // 'phone:ntext',
                   // 'drop_location:ntext',
                   // 'payment_type:ntext',
                   // 'check_number:ntext',
                   'number_bales:ntext',
                   'order_amount:ntext',
                   // 'created_at',
                   // 'updated_at',
                   ['class' => 'yii\grid\ActionColumn'],
               ],
           ]);
       } elseif (Yii::$app->user->identity->getIsParent()) {
           print GridView::widget([
               'dataProvider' => $dataProvider,
               //'filterModel' => $searchModel,
               'columns' => [
                   ['class' => 'yii\grid\SerialColumn'],
                   'name:ntext',
                   ['attribute' => 'scout.name',
                       'header' => 'Scout',
                   ],
                   'subdivision:ntext',
                   'house_number:ntext',
                   'street_name:ntext',
                   // 'city:ntext',
                   // 'zip:ntext',
                   // 'phone:ntext',
                   // 'drop_location:ntext',
                   // 'payment_type:ntext',
                   // 'check_number:ntext',
                   'number_bales:ntext',
                   'order_amount:ntext',
                   // 'created_at',
                   // 'updated_at',
                   ['class' => 'yii\grid\ActionColumn'],
               ],
            ]);
       } elseif (Yii::$app->user->identity->getIsLeader || Yii::$app->user->identity->getIsAdmin()) {
           print $this->render('_search', ['model' => $searchModel]);
           print GridView::widget([
               'dataProvider' => $dataProvider,
               //'filterModel' => $searchModel,
               'columns' => [
                   ['class' => 'yii\grid\SerialColumn'],
                   'name:ntext',
                   ['attribute' => 'scout.name',
                       'header' => 'Scout',
                   ],
                   'subdivision:ntext',
                   'house_number:ntext',
                   'street_name:ntext',
                   // 'city:ntext',
                   // 'zip:ntext',
                   // 'phone:ntext',
                   // 'drop_location:ntext',
                   // 'payment_type:ntext',
                   // 'check_number:ntext',
                   'number_bales:ntext',
                   'order_amount:ntext',
                   // 'created_at',
                   // 'updated_at',
                   ['class' => 'yii\grid\ActionColumn'],
               ],
           ]);
       }
    ?>


</div>
