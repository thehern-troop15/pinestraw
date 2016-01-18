<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'scoutid',
            'subdivision:ntext',
            'house_number:ntext',
            'street_name:ntext',
            'city:ntext',
            'zip:ntext',
            'phone:ntext',
            'drop_location:ntext',
            'payment_type:ntext',
            'check_number:ntext',
            'number_bales:ntext',
            'order_amount:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
