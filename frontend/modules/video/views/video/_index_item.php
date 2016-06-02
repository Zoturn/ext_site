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
    <p>
        <?= Html::a(Html::encode($model->title), ['view', 'alias' => $model->alias], ['class' => 'video_title']); ?>
    </p>
</div>
<div class="col-sm-12">
    <?= $model->description; ?>
</div>
<div class="col-sm-12">
    <?php
    echo \Yii::t('ru', 'Tags: ');
    $tags = explode(",", $model->tags);
    foreach ($tags as $value) {
        echo Html::a(Html::encode($value), ['', 'VideoSearch[tags]' => $value], ['class' => 'tag']) . ', ';
    }
    ?>
</div>
<div class="video_item_footer">
    <div class="col-sm-2">
        <?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/v_comment.png')[1], ['class' => 'ico']) . $model->CommentsCount . ' '; ?>
    </div>
    <div class="col-sm-3">
        <?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/v_clock.png')[1], ['class' => 'ico']) . $model->duration . \Yii::t('ru', ' min.') ?>
    </div>
    <?php
// Если видео куплено отображать другим цветом
    if ($model->_isBuy != NULL || $model->_isAuthor) {
        $this->registerCss("tr[data-key='{$model->id}']  { background: #FAFBF8; }");
    }
    ?>
    <div class="col-sm-4 parsed" id="parsed-<?= $model->id ?>">
        <?php
        if ($model->_isBuy != NULL || $model->val == NULL) {
            if (!Yii::$app->user->isGuest) {
                if ($model->_isParsed != NULL) {
                    echo '<span id="iparsed' . $model->id . '"><i class="icon-check"> </i>'
                    . Html::a(
                            \Yii::t('ru', 'Parsed'), ['deleteparsed', 'id' => $model->id], ['data-pjax' => '#checked-parsed' . $model->id])
                    . '</span>';
                } else {
                    echo '<span id="iparsed' . $model->id . '"><i class="icon-check-empty"> </i>'
                    . Html::a(
                            \Yii::t('ru', 'Parsed'), ['addparsed', 'id' => $model->id], ['data-pjax' => '#checked-parsed' . $model->id])
                    . '</span>';
                }
            } else {
//                echo \Yii::t('ru', 'You are not logged in');
            }
        } else {
            echo '  ';
        }
        ?>
    </div>
    <div class="col-sm-3">
        <?= "<span class='i'><span class='video_item_rating'>" . \Yii::t('ru', 'Rating:') . "</span> " . $model->rating . "</span>" ?>
    </div>
</div>
<?php Pjax::begin(['id' => 'iparsed' . $model->id, 'linkSelector' => '#parsed-' . $model->id . ' a', 'enablePushState' => false]); ?>
<?php Pjax::end(); ?>