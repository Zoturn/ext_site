<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\select2\Widget;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video */
$this->registerMetaTag(['name' => 'description', 'content' => $model->meta], 'description');
$this->title = !empty($model->page_title) ? $model->page_title : $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Videos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;
?>
<div class="row">

    <div class="container-fluid">
        <div class="col-xs-12 video_view">
            <div class="video_view_header">
                <div class="video_view_header__left"><i class="icon-play"></i></div>
                <?php
                if (Yii::$app->user->can('BUpdateVideo')) {
                    echo Html::a('', '/backend/video/video/update/?id=' . $model->id, ['class' => 'btn btn-default icon-edit b-edit', 'title' => 'Перейти к материалу', 'target' => '_blank']);
                }
                ?>
                <h3><?= $model->title ?></h3>
            </div>
        </div>
        <div class="col-xs-3">
            <?=
            $this->render('_rating', [
                'id' => $model->id,
                'is_rating' => $model->_isRating,
                'rating' => $model->rating,
                'val' => $model->val,
                'is_buy' => $model->_isBuy,
            ])
            ?>
            <div class="video_view__gold">
                <span class="cl"><?= \Yii::t('ru', 'Price') ?>: </span><?php
                echo $val = (!empty($model->val)) ? $model->val
                . ' '
                . Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/fsp.png')[1], ['class' => 'trainings_logo'])
                . '<br>' : \Yii::t('ru', 'Free video')
                ?>
                <br><?= $model->message ?>
                <?php
                $options = [
                    'class' => 'btn btn-primary buy',
                    'data-toggle' => 'modal',
                    'data-target' => '#myModal',
                    'title' => \Yii::t('ru', 'Buy video')
                ];

                if (empty($model->val) || $model->_isBuy == true || $model->_isAuthor || \Yii::$app->user->can('administrateVideo')) {
                    Html::addCssClass($options, 'hide');
                    echo 'Пароль: ' . $model->password;
                }

                if (Yii::$app->user->isGuest) {
                    Html::addCssClass($options, 'disabled');
                }

                if (!empty($model->val)) {
                    echo Html::button(\Yii::t('ru', 'Buy Access'), $options);
                }
                ?>
            </div>
            <br>
            <div class="video_view_course">
                <?php
                if ($model->ids != NULL || $model->ids != '') {
                    $course = explode(",", $model->ids);
                    echo \Yii::t('ru', 'VIDEO INCLUDED IN THE COURSE:') . ' <hr>';
                    foreach ($course as $value) {
                        $video_model = $model->getvideomodel($value);
                        echo '<i class="icon-play-circle"></i> ';
                        echo Html::a(Html::encode($video_model->title), [ 'view', 'alias' => $video_model->alias], ['class' => 'course']);
                        echo '<br><br>';
                    }
                }
                ?>
            </div>
            <?php
            if (empty($model->val) || $model->_isBuy == true || $model->_isAuthor || \Yii::$app->user->can('administrateVideo')) {
                if ($model->conspects) {
                    echo '<br>' . \Yii::t('ru', 'OUTLINE:') . ' <hr>'
                    . '<h3 class="icon-paper-clip"></h3> <a href="/statics/web/video/files/' . $model->conspects . '" class="consp">' . $model->conspects . '</a>';
                }
            }
            ?>
            <div class="gift" id="gifter">
                <?php
                if (Yii::$app->user->can('administrateVideo')) {
                    echo '<br><br>'
                    . '<div class="admin_func">'
                    . \Yii::t('ru', 'Make the gift');
                    $gift_form = ActiveForm::begin([
                                'id' => 'gift',
                                'method' => 'post',
                                'action' => [ 'gift'],
                    ]);
                    ?>
                    <?=
                    $gift_form->field($model, 'gift_user')->widget(Widget::className(), [
                        'options' => [
                            'prompt' => \Yii::t('ru', 'Select...'),
                        ],
                        'settings' => [
                            'width' => '100%',
                            'minimumInputLength' => 3,
                        ],
                        'items' => $model->AllUsers,
                    ])->label(false);
                    ?>
                    <?= $gift_form->field($model, 'id')->hiddenInput()->label(false); ?>
                    <?= Html::submitButton(\Yii::t('ru', 'Make the gift'), ['class' => 'btn btn-primary btn_gift'], ['id' => 'gift-sbm']) ?>
                    <?php
                    ActiveForm::end();
                    Pjax::begin(['id' => 'gifter_info', 'formSelector' => '#gift', 'enablePushState' => false]);
                    Pjax::end();
                    echo '</div><br>'
                    . '<div class="gifter_info"></div>';
                }
                if (Yii::$app->user->can('administrateVideo') || $model->_isAuthor) {
                    echo Html::a(\Yii::t('ru', 'Stat'), ['stat', 'id' => $model->id], ['class' => 'stat', 'target' => '_blank']);
                }
                ?>
            </div>
        </div>
        <div class="col-xs-9">
            <?php
            $VideoLink = parse_url($model->embed);

            // Нормальная ссылка
            If (isset($VideoLink['host']) && isset($VideoLink['path'])) {
                // Видео на VIMEO.COM
                If (strcmp($VideoLink['host'], 'vimeo.com') == 0) {
                    $Video_HTML = '<iframe src="http://player.vimeo.com/video';
                    $Video_HTML .= $VideoLink['path'];
                    $Video_HTML .= '?title=0&amp;byline=0&amp;portrait=0" width="745px" height="400px" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                }

                // Видео на YOUTUBE.COM
                If (
                        (strcmp($VideoLink['host'], 'youtube.com') == 0) ||
                        (strcmp($VideoLink['host'], 'www.youtube.com') == 0)
                ) {
                    parse_str($VideoLink['query'], $VideoStr);
                    $Video_HTML = '<iframe width="745px" height="400px" src="http://www.youtube.com/embed/' . $VideoStr['v'] . '" frameborder="0" allowfullscreen></iframe>';
                }
            } echo $Video_HTML;
            ?>
            <div class="video_view__info">
                <span class="cl"><?= \Yii::t('ru', 'Author') ?>: </span><?= $model->user->username; ?>
                <b class="cl"><i class="icon-calendar"></i> </b><?= \Yii::$app->formatter->asDate($model->date); ?>
                <b class="cl"><i class="icon-time"></i> </b><?= $model->duration . \Yii::t('ru', ' min.'); ?>
                <div class="right parsed" id="parsed-<?= $model->id ?>">
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
                            echo
                            \Yii::t('ru', 'You are not logged in');
                        }
                    } else {
                        echo ' - ';
                    }
                    ?>
                </div>
                <?php Pjax::begin(['id' => 'iparsed' . $model->id, 'linkSelector' => '#parsed-' . $model->id . ' a', 'enablePushState' => false]); ?>
                <?php Pjax::end(); ?>
                <hr>
            </div>
            <span style="white-space:pre-wrap;"><?= $model->description ?></span>
            <br>
            <br>
            <?php
            echo \Yii::t('ru', 'Tags: ');
            $tags = explode(",", $model->tags);
            foreach ($tags as $value) {
                echo Html::a(Html::encode($value), ['/video/', 'VideoSearch[tags]' => $value], ['class' => 'tag']) . ', ';
            }
            ?>
            <?php
            if (Yii::$app->base->hasExtension('comments') && Yii::$app->user->can('viewComments') && $model->comments != 1) :
                echo '<br><br>';
                echo \vova07\comments\widgets\Comments::widget(
                        [
                            'model' => $model,
                            'jsOptions' => [ 'offset' => 80
                            ]
                        ]
                );
            endif;
            ?>                       
        </div>
    </div><!--/.col-md-8-->
</div><!--/.row-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= \Yii::t('ru', 'Close') ?></span></button>
                <h4 class="modal-title" id="myModalLabel"><?= \Yii::t('ru', 'Buy') ?> "<?= $model->title ?>"</h4>
            </div>
            <div class="modal-body">
                <?= \Yii::t('ru', 'Do you really want to buy this video?') ?>
            </div>
            <div class="modal-footer">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'val')->hiddenInput()->label(false); ?>
                <button type="button" class="btn btn-default" data-dismiss="modal"> <?= \Yii::t('ru', 'No') ?></button>
                <?= Html::submitButton(\Yii::t('ru', 'Yes, of course'), ['class' => 'btn btn-primary']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>