<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Patrol;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Scout */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scout-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::hiddenInput('where', $where); ?>

    <?= $form->field($model, 'patrolid')->dropDownList(ArrayHelper::map(Patrol::find()->all(), 'id', 'name'), ['prompt' => 'Choose a Patrol'])->label('Patrol') ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
