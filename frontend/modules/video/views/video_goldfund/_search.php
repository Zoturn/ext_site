<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video_goldfundSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-goldfund-search row">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <div class="col-sm-2">
        <?= $form->field($model, 'is_buy')->checkbox(['name' => 'is_buy','onclick' => 'submit()']) ?>
    </div>
    <div class="col-sm-10">
        <?= $form->field($model, 'is_parsed')->checkbox(['name' => 'is_parsed','onclick' => 'submit()']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
