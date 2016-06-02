<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\RoomsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rooms-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'net') ?>

    <?= $form->field($model, 'alias') ?>

    <?= $form->field($model, 'snippet') ?>

    <?php // echo $form->field($model, 'promo') ?>

    <?php // echo $form->field($model, 'logo') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'info') ?>

    <?php // echo $form->field($model, 'instruction') ?>

    <?php // echo $form->field($model, 'bonus') ?>

    <?php // echo $form->field($model, 'sortOrder') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('ru', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('ru', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
