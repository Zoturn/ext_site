<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\LessonsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <div class="">
        <?= '<div class="lessonssearch_title">' . \Yii::t('ru', 'Author video:') . '</div>' ?>
        <?= $form->field($model, 'author_id')
            ->dropDownList($model->authors, ['prompt' => \Yii::t('ru', 'Select...'), 'onchange' => 'submit()'])
            ->label(false) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
