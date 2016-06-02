<?php

use yii\helpers\Html;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="lesson">
    <div class="lesson_title">
        <?= Html::a(Html::encode($model->title), ['video/view', 'alias' => $model->alias]); ?>
    </div>
    <div class="center">
        <?= Html::a(Html::img('/statics/web/video/previews/' . $model->preview, ['class' => 'lesson_img']), ['video/view', 'alias' => $model->alias]); ?>
    </div>
    <div class="lesson_footer">
        <small><?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/calendar.png')[1], ['class' => 'ico baseline']) . \Yii::$app->formatter->asDate($model->date); ?></small>
        <span class="lesson_author"><?= \Yii::t('ru', 'Author') ?>: <?= $model->user->username; ?></span>
        <?= '<br>' ?>
    </div>
</div>