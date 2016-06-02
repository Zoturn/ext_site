<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use vova07\fileapi\Widget as FileAPI;
use kartik\select2\Select2;
use vova07\select2\Widget;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="overflow">
    <?php
    $form = ActiveForm::begin([
                'enableAjaxValidation' => true
    ]);
    ?>

    <div class="col-sm-12">
        <?= $form->field($model, 'section')->checkbox() ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model, 'title') ?>
    </div>
    <div class="col-sm-3">
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
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'page_title') ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'description')->textarea(['style' => 'height:108px']) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'embed') ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'alias') ?>
    </div>
    <div class="col-sm-6">
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
        <?= $form->field($model, 'duration') ?>
    </div>
    <div class="col-sm-3">
        <?=
        $form->field($model, 'conspects')->widget(
                FileAPI::className(), [
            'preview' => false,
            'settings' => [
                'url' => ['/video/video/fileapi-upload'],
            ]
                ]
        )
        ?>
    </div>
    <div class="col-sm-6">
        <?=
        $form->field($model, 'tags')->widget(Select2::classname(), [
            'options' => ['placeholder' => 'Выбрать ...'],
            'pluginOptions' => [
                'tags' => $model->Tags,
                'maximumInputLength' => 10
            ],
        ]);
        ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model, 'password') ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model, 'id_training') ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'val') ?>
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
                'url' => Url::to(['video/getlimits/']),
                'loadingText' => 'Загрузка ...'
            ]
        ]);
        ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'ids'); ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'comments')->checkbox() ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model, 'gp')->checkbox() ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($model, 'stat_f')->checkbox() ?>
    </div>
    <div class="col-sm-6">
        <?=
        $form->field($model, 'preview')->widget(
                FileAPI::className(), [
            'crop' => true,
            'cropResizeWidth' => '240',
            'cropResizeHeight' => '157',
            'jcropSettings' => [
                'aspectRatio' => 4 / 3,
                'bgColor' => '#ffffff',
                'maxSize' => [568, 800],
                'minSize' => [100, 100],
                'keySupport' => false, // Important param to hide jCrop radio button.
                'selection' => '100%'
            ],
            'settings' => [
                'url' => ['/video/video/fileapi-upload'],
            ]
                ]
        )
        ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'meta')->textarea(['rows' => 4]); ?>
    </div>
    <div class="form-group col-sm-12">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('ru', 'Create') : Yii::t('ru', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>