<?php

use yii\helpers\Html; 

/* @var $this yii\web\View */

$this->title = 'Troop 15 - Pinestraw';
?>
<div class="site-index">

    <div class="jumbotron">

<?php

if (!Yii::$app->user->isGuest && !Yii::$app->user->identity->getIsScout() && !Yii::$app->user->identity->getIsParent() && !Yii::$app->user->identity->getIsAdmin()) {
?>
        <h1>Are you a Scout or a Parent?</h1>
        
        <p><?=Html::a('Scout', ['/scout/create'], ['class'=>'btn btn-lg btn-success']) ?>
        <p><?=Html::a('Parent', ['/scoutparent/create'], ['class'=>'btn btn-lg btn-success']) ?>
<?php
} elseif (!Yii::$app->user->isGuest && Yii::$app->user->identity->getIsParent() && !Yii::$app->user->identity->getIsLeader() ) {
?>
        <i>Please click on "My Scouts" to add your Scouts"</i><br><br>
        <p><?=Html::a('New Order', ['/order/create'], ['class'=>'btn btn-lg btn-success']) ?>
        <p><?=Html::a('Show Orders', ['/order/index'], ['class'=>'btn btn-lg btn-success']) ?>
<?php
} elseif (Yii::$app->user->identity->getIsLeader()) {
?>
        <h1>Leader Access</h1>
        <p><?=Html::a('New Order', ['/order/create'], ['class'=>'btn btn-lg btn-success']) ?>
        <p><?=Html::a('New Order - Any Scout', ['/order/createany'], ['class'=>'btn btn-lg btn-success']) ?>
        <p><?=Html::a('Show Orders', ['/order/index'], ['class'=>'btn btn-lg btn-success']) ?>
<?php
} elseif (Yii::$app->user->identity->getIsScout()) {
?>
        <p><?=Html::a('New Order', ['/order/create'], ['class'=>'btn btn-lg btn-success']) ?>
        <p><?=Html::a('Show Orders', ['/order/index'], ['class'=>'btn btn-lg btn-success']) ?>
<?php
}
?>
    </div>

</div>
