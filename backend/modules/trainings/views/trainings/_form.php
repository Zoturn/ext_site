<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\jui\DatePicker;
use vova07\select2\Widget;

/* @var $this yii\web\View */
/* @var $model app\modules\trainings\models\Trainings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trainings-form overflow">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-sm-12">
        <?php if (Yii::$app->user->can('administrateTrainings')) { ?>
            <?=
            $form->field($model, 'author_id')->widget(Widget::className(), [
                'options' => [
                    'prompt' => \Yii::t('ru', 'Select...'),
                ],
                'settings' => [
                    'width' => '100%',
                    'minimumInputLength' => 3,
                ],
                'items' => $model->AllUsers,
            ])
            ?>
        <?php } ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'url')->textInput(['maxlength' => 256]) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'description')->textarea(['style' => 'height:108px']) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'val')->textInput() ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'alias')->textInput(['maxlength' => 256]) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'password')->textInput(['maxlength' => 256]) ?>
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
                'url' => Url::to(['trainings/getlimits/']),
                'loadingText' => 'Загрузка ...'
            ]
        ]);
        ?>
    </div>
    <div class="col-sm-3">
        <?=
        $form->field($model, 'date')->widget(
                DatePicker::className(), [
            'options' => [
                'class' => 'form-control'
            ],
            'clientOptions' => [
                'dateFormat' => 'dd.mm.yy',
                'changeMonth' => true,
                'changeYear' => true
            ]
                ]
        );
        ?>
    </div>
    <div class="col-sm-3">
        <?php if (Yii::$app->user->can('administrateTrainings')) { ?>
            <?= $form->field($model, 'status_id')->dropDownList($statusArray) ?>
        <?php } ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model, 'time_start')->textInput() ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model, 'time_end')->textInput() ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'meta')->textarea(['rows' => 4]); ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'stat_f')->checkbox() ?>
    </div>
    <div class="form-group col-sm-3">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('ru', 'Create') : Yii::t('ru', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
