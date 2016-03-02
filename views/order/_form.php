<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Scoutrelation;
use app\models\Scout;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->registerJs("$('#number_bales').keyup(function(){
        var numbales = $('#number_bales').val();
        var fee = numbales * 4.5;
        fee = fee.toFixed(2);
        $('#order_amount').val(fee);
});"); 
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(['id' => 'orderform']); ?>


    <?php 
       if (Yii::$app->user->identity->getIsScout())
           print $form->field($model, 'scoutid')->dropDownList($scoutlist)->label('Scout');
       else
           print $form->field($model, 'scoutid')->dropDownList($scoutlist, ['prompt' => 'Choose a Scout'],['options' => [ $model->scoutid => ['selected' => true]]])->label('Scout');
    ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'subdivision')->textInput() ?>

    <?= $form->field($model, 'house_number')->textInput() ?>

    <?= $form->field($model, 'street_name')->textInput() ?>

    <?= $form->field($model, 'city')->textInput() ?>

    <?= $form->field($model, 'zip')->textInput() ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'drop_location')->textInput() ?>

    <?= $form->field($model, 'payment_type')->dropDownList(['Cash' => 'Cash', 'Check' => 'Check'],['prompt'=>'Select Payment Type']); ?>

    <?= $form->field($model, 'check_number')->textInput() ?>

    <div class="orderr" id="order-numbales"><?= $form->field($model, 'number_bales')->textInput(['id' => 'number_bales']) ?></div>

    <div class="orderr" id="order-amount"><?= $form->field($model, 'order_amount')->textInput(['id' => 'order_amount', 'disabled' => 'true']) ?></div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
