<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use vova07\select2\Widget;

/* @var $this yii\web\View */
/* @var $model app\modules\trainings\models\Coaching */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coaching-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="col-sm-6">
        <?= $form->field($model, 'user_id')->widget(Widget::className(), [
                'options' => [
                    'prompt' => \Yii::t('ru', 'Select...'),
                ],
                'settings' => [
                    'width' => '100%',
                ],
                'items' => $model->AllUsers,
            ]) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'photo')->textInput(['maxlength' => 32]) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'description')->textarea(['style' => 'height:108px']) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'fsp')->textInput() ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'link')->textInput(['maxlength' => 32]) ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model, 'type_id')->dropDownList($model->typer, ['id' => 'type_id', 'prompt' => Yii::t('ru', 'Select...')]); ?>
    </div>
    <div class="col-sm-3">
        <?php
        echo $form->field($model, 'limit_id')->widget(DepDrop::classname(), [
            'options' => ['id' => 'limit_id'],
            'data' => $model->getCurrentLimits($model->type_id),
            'pluginOptions' => [
                'depends' => ['type_id'],
                'placeholder' => Yii::t('ru', 'Select...'),
                'url' => Url::to(['coaching/getlimits/']),
                'loadingText' => 'Загрузка ...'
            ]
        ]);
        ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'link_forum')->textInput(['maxlength' => 32]) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('ru', 'Create') : Yii::t('ru', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
