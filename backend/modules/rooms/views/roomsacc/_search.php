<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\RoomsAccSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rooms-acc-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'room_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'status_id') ?>

    <?= $form->field($model, 'nickname') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('ru', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('ru', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
