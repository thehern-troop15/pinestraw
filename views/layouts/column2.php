<?php $this->beginContent('@app/views/layouts/main.php');

use yii\widgets\Block;
use kartik\widgets\SideNav;

?>

<?php Block::begin(array('id'=>'sidebar')); ?>

    <?php

                echo SideNav::widget([
                'type' => SideNav::TYPE_DEFAULT,
                'heading' => Yii::t('app','Party Options'),
                'items' => 
                [
                    [
                        'url' => ['/site/index'],
                        'label' => 'Home',
                        'icon' => 'home'
                    ],
                    ['label' => Yii::t('app','Create'), 'icon'=>'plus', 'url'=>['create']]
                  ]
        ]);
   ?>   
<?php Block::end(); ?>


<div class="row">
   <div class="col-md-3">
    <div class="pg-sidebar">          
      <?= $this->blocks['sidebar']; ?>

    </div>      
  </div>
  <div class="col-md-9">
    <?= $content; ?>
  </div>
</div>
<?php $this->endContent(); ?>

