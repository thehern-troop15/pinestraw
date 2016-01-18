<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Scout;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Scoutrelation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scoutrelation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'scoutid')->dropDownList(ArrayHelper::map(Scout::find()->all(), 'id', 'name'), ['prompt' => 'Choose a Scout'])->label('Scout') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Link to Scout' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

    </div>
    <div class="form-group">
        <?= Html::a('Not Listed', ['/scout/create', 'where' => 'fromparent'], ['class' => 'btn btn-success']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
