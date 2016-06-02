<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->registerMetaTag(['name' => 'description', 'content' => Yii::$app->meta->meta_description], 'description');

/* @var $this yii\web\View */
/* @var $searchModel app\modules\trainings\models\TrainingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::$app->meta->title;
$this->params['subtitle'] = yii::t('ru', 'Trainings Panel');
$this->params['breadcrumbs'] = [
    yii::t('ru', 'Trainings')
];

$js = "$(document).ready(function(){
    $('.pop').popover({delay:'100', html:true, placement:'left'});
});";
$this->registerJs($js);
?>
<div class="trainings-index">

    <h1> <?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/trainings.png')[1], ['class' => 'trainings_logo']) ?>
        <?= yii::t('ru', 'Trainings') ?></h1>
    <div class="row">
        <div class="col-sm-8">
            Посещай онлайн тренировки и повышай свой уровень игры вместе с нами.
        </div>
        <div class="col-sm-4">
            <div class="left small">
                Добавься в скайп и получай<br> уведомления о тренировках
            </div>
            <div class="skype right">
                freestylepoker
            </div>
        </div>
    </div>


    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row col-sm-12">
        <?php
        echo GridView::widget([
            'id' => 'trainings',
            'dataProvider' => $dataProvider,
            'caption' => yii::t('ru', 'Trainings'),
            'layout' => "{items}",
            'rowOptions' => function ($model) {
                return ['class' => 'trainings_row'];
            },
                    'showHeader' => false,
                    'tableOptions' => ['class' => 'trainings_table'],
                    'columns' => [
                        [
                            'attribute' => 'date',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<div class="trainings_date">' . \Yii::$app->formatter->asDate($model->date)
                                        . '</div><div class="trainings_time">' . $model->time_start . ' - '
                                        . $model->time_end . ' МСК</div>';
                            }
                        ],
                        [
                            'attribute' => 'title',
                            'format' => 'raw',
                            'enableSorting' => false,
                            'value' => function ($model) {
                                return $this->render('view', [
                                            'model' => $model,
                                ]);
                            }
                                ],
                                [
                                    'label' => '',
                                    'format' => 'html',
                                    'contentOptions' => ['class' => 'training_table__row'],
                                    'value' => function( $model) {
                                return $model->type["name"] . ' ' . $model->limit["name"];
                            }
                                ],
                                [
                                    'label' => \Yii::t('ru', 'Price'),
                                    'attribute' => 'val',
                                    'contentOptions' => ['class' => 'training_table__row'],
                                    'format' => 'raw',
                                    'enableSorting' => false,
                                    'value' => function($model) {
                                if ($model->val == NULL) {
                                    return '<span class="not_buyed">' . \Yii::t('ru', 'Free training') . '</span>';
                                } else {
                                    if ($model->_isBuy) {
                                        return '<i class="icon-ok"> </i>' . \Yii::t('ru', 'Buyed');
                                    } else {
                                        return '<span class="fsp">' . $model->val . '</span>&nbsp;<span class="buyed"></span>';
                                    }
                                }
                            }
                                ],
                                [
                                    'label' => '',
                                    'format' => 'raw',
                                    'value' => function($model) {
                                        if (\Yii::$app->user->isGuest) {
                                            return Html::tag('div', Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/login.png')[1])
                                                            . Html::a('Войдите', ['/login']) . ' или<br>'
                                                            . Html::a('Зарегистрируйтесь', ['/signup']), ['class' => 'login_please']);
                                        } elseif ($model->_isBuy || Yii::$app->user->can('administrateTrainings')) {
                                            //return Html::a($model->password . Html::tag('i', '', ['class' => 'icon-chevron-sign-right']), $model->url, ['class' => 'training_btn_go', 'onClick' => 'copyr(this)']);
//                                            return Html::tag('div', $model->password
//                                                            . Html::a(Html::tag('i', '', ['class' => 'icon-chevron-sign-right']), $model->url), ['class' => 'training_btn_go']);
                                            if ($model->password) {
                                                return Html::tag('div', \Yii::t('ru', 'See')
                                                                . Html::a(Html::tag('i', '', ['class' => 'icon-chevron-sign-right']), $model->url), ['class' => 'training_btn_go pop',
                                                            'rel' => 'popover',
                                                            'data-content' => "1. " . \Yii::t('ru', 'Copy password') . " <b>" . $model->password . "</b>. <br><br> 2. "
                                                            . \Yii::t('ru', 'Go to link') . " <a href='" . $model->url . "'>" . $model->url . "</a>"
                                                ]);
                                            } else {
                                                return
                                                        Html::a(\Yii::t('ru', 'See') . Html::tag('i', '', ['class' => 'icon-chevron-sign-right']), $model->url, ['class' => 'training_btn_go', 'target' => '_blank']);
                                            }
                                        } elseif (!$model->val) {
                                            return Html::a(\Yii::t('ru', 'Go') . Html::tag('i', '', ['class' => 'icon-chevron-sign-right']), $model->url, ['class' => 'training_btn_go']);
                                        } elseif (!$model->_isBuy && $model->val) {
                                            $options = [
                                                'class' => 'training_btn btn btn-primary buy',
                                                'data-toggle' => 'modal',
                                                'data-target' => '#myModal' . $model->id,
                                                'title' => 'Купить доступ к просмотру'
                                            ];
                                            return Html::button(\Yii::t('ru', 'Buy'), $options);
                                        }
                                    }
                                        ],
                                    ],
                                ]);
                                ?>
    </div>
</div>