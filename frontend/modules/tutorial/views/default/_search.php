<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\tutorial\models\TutorialSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tutorial-search">
    <div class="row">
        <?php
        $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
        ]);
        ?>
        <div class="col-sm-6">
            <?= $form->field($model, 'title') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'category_id') ?>
        </div> 
        <div class="form-group col-sm-12">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
