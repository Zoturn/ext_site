<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="col-sm-12">
    <h3>
        <?= Html::a(Html::encode($model->title), ['view', 'alias' => $model->alias]); ?>
        <?php //  Html::a(Html::encode($model->title), ['view', 'id' => $model->id, 'alias' => $model->alias]);  ?>

        <?= Html::img('/statics/web/video/previews/' . $model->preview, ['style' => 'width:100px; float:right; padding:0px']) ?>
    </h3>
</div>
<div class="col-sm-12">
    <?= '<b>Автор: </b>' . $model->author ?>
</div>
<div class="col-sm-12">
    <?= '<b>Описание: </b>' . $model->description; ?>
</div>
<div class="col-sm-12">
    <?php
    echo '<b>Теги: </b>';
    $tags = explode(",", $model->tags);
    foreach ($tags as $value) {
        echo '<a href="?VideoSearch[tags]=' . $value . '">#' . $value . '</a> ';
    }
    ?>
</div>
<div class="col-sm-3">
    <?= '<b>Дата: </b>' . $model->_date; ?>
</div>
<div class="col-sm-9">
    <?= '<b>Цена: </b>' . $model->val . ' ' . Yii::t('ru', 'Val') ?>
</div>
<div class="col-sm-3">
    <?= '<b>Продолжительность: </b>' . $model->duration . ' мин.' ?>
</div>
<div class="col-sm-3">
    <?= '<b>Комментарии: </b>' . $model->CommentsCount . ' '; ?>
</div>
<?php
// Если видео куплено отображать другим цветом
if ($model->_isBuy != NULL || $model->_isAuthor || \Yii::$app->user->can('administrateVideo')) {
    $this->registerCss("div.item[data-key='{$model->id}']  { background: #00FFAE; }");
}
?>
<div id="parsed-<?= $model->id ?>">
    <?php
    if ($model->_isBuy != NULL || $model->val == NULL) {
        if (!Yii::$app->user->isGuest) {
            if ($model->_isParsed != NULL) {
                echo Html::a(
                        '[x] Убрать из разобраного', ['deleteparsed', 'id' => $model->id], ['data-pjax' => '#checked-parsed' . $model->id]);
            } else {
                echo Html::a(
                        '(&) Отметить разобранным', ['addparsed', 'id' => $model->id], ['data-pjax' => '#checked-parsed' . $model->id]);
            }
        } else {
            echo
            'Вы не зарегестрированы';
        }
    }
    else {
        echo 'Разобрать нельзя';
    }
    ?>
</div>
<?php Pjax::begin(['id' => 'checked-parsed' . $model->id, 'linkSelector' => '#parsed-' . $model->id . ' a', 'enablePushState' => false]); ?>
<?php Pjax::end(); ?>