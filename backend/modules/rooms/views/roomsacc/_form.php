<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\select2\Widget;

/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\RoomsAcc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rooms-acc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'room_id')->widget(Widget::className(), [
                'options' => [
                    'prompt' => \Yii::t('ru', 'Select...'),
                ],
                'settings' => [
                    'width' => '100%',
                ],
                'items' => $model->AllRooms,
            ]) ?>

   <?= $form->field($model, 'user_id')->widget(Widget::className(), [
                'options' => [
                    'prompt' => \Yii::t('ru', 'Select...'),
                ],
                'settings' => [
                    'width' => '100%',
                ],
                'items' => $model->AllUsers,
            ]) ?>

    <?= $form->field($model, 'status_id')->checkbox() ?>

    <?= $form->field($model, 'nickname')->textInput(['maxlength' => 100]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('ru', 'Create') : Yii::t('ru', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
