<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\models\Scout;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Troop 15',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'All Orders', 'url' => ['/order/leader'],
                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->GetIsLeader(),
            ],
            ['label' => 'My Orders', 'url' => ['/order/index'],
                'visible' => !Yii::$app->user->isGuest,
            ],
            ['label' => 'Scout Profile', 'url' => ['/scout/viewme'],
                'visible' => !Yii::$app->user->isGuest && (Yii::$app->user->identity->getIsScout()),
            ],
            ['label' => 'My Scouts', 'url' => ['/scoutrelation/index'],
                'visible' => !Yii::$app->user->isGuest && (Yii::$app->user->identity->getIsParent()),
            ],
            ['label' => 'All Scouts', 'url' => ['/scout/index'],
                'visible' => !Yii::$app->user->isGuest && (Yii::$app->user->identity->getIsAdmin() || Yii::$app->user->identity->getIsLeader()),
            ],
            ['label' => 'Patrols', 'url' => ['/patrol/index'],
                'visible' => !Yii::$app->user->isGuest && (Yii::$app->user->identity->getIsAdmin() || Yii::$app->user->identity->getIsLeader()),
            ],
            ['label' => 'Users', 'url' => ['/user/admin/index'],
                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->getIsAdmin(),
            ],
            ['label' => 'Home', 'url' => ['/site/index'],
                'visible' => !Yii::$app->user->isGuest,
            ],
            Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/user/security/login']] :
                [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
                ['label' => 'Register', 'url' => ['/user/registration/register'], 'visible' => Yii::$app->user->isGuest],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            //'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Troop 15 <?= date('Y') ?></p>

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
