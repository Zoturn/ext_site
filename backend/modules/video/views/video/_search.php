<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\VideoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

   <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'val') ?>

    <?php  echo $form->field($model, 'section') ?>

    <?php  echo $form->field($model, 'ids') ?>

    <?php  echo $form->field($model, 'date') ?>

    <?php  echo $form->field($model, 'id_training') ?>

    <?php  echo $form->field($model, 'type_id') ?>

    <?php echo $form->field($model, 'limit_id') ?>

    <?php  echo $form->field($model, 'tags') ?>

    <?php  echo $form->field($model, 'gp') ?>

    <?php  echo $form->field($model, 'author') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
