<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->registerMetaTag(['name' => 'description', 'content' => Yii::$app->meta->meta_description], 'description');

//---------------- CASHING ----------------

$dependency = new \yii\caching\DbDependency([
    'sql' => 'SELECT COUNT(*) FROM {{%video_parsed}};'
        ]);
$yget = Yii::$app->request->get();
if ($this->beginCache('gp', ['dependency' => $dependency, 'duration' => 600, 'enabled' => empty($yget)])) {
//    -----------------------------------

    /* @var $this yii\web\View */
    /* @var $searchModel app\modules\video\models\Video_goldfundSearch */
    /* @var $dataProvider yii\data\ActiveDataProvider */

    $this->title = Yii::$app->meta->title;
    $this->params['breadcrumbs'][] = Yii::t('ru', 'Video Goldfunds');
    ?>
    <div class="video-goldfund-index">

        <h1> <?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/gp.png')[1], ['class' => 'trainings_logo']) ?>
            <?= Yii::t('ru', 'Video Goldfunds'); ?></h1>
        <p>
            На этой странице мы собрали лучшие обучающие видео нашей школы, а материалы не вошедшие в Золотой фонд вы найдете в разделе видео
        </p>
        <?php
        if (!\Yii::$app->user->isGuest) {
            echo $this->render('_search', ['model' => $searchModel]);
        }

        $video_type_count = $searchModel->VideoTypeCount;

        for ($i = 1; $i <= $video_type_count; $i++) {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $i);
            $table = \app\modules\video\models\VideoType::findOne(['id' => $i]);
            if ($table) {
                $title_table = $table->getAttribute('name');
                $description_table = $table->getAttribute('description');
            } else {
                $title_table = '';
                $description_table = '';
            }

            // Выводим процент доступности
            // echo $searchModel->search(Yii::$app->request->queryParams, $i, true);
            ?>
            <div class="col-sm-9 row">
                <?php
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'headerRowOptions' => ['class' => 'gold_header'],
                    'caption' => ''
                    . '<div class="gold_table_title">'
                    . $title_table . '</div>'
                    . '<div class="right">Доступно: <div class="gold_table_percent">' . $searchModel->search(Yii::$app->request->queryParams, $i, true)
                    . '%</div></div>',
                    'captionOptions' => ['class' => 'gold_fund_caption'],
                    'summary' => false,
                    'rowOptions' => function ($model) {
                if ($model->_isBuy) {
                    return ['class' => 'gold_column__buyed gold_row'];
                } else {
                    return ['class' => 'gold_row'];
                }
            },
                    'columns' => [
//                    ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'limit_id',
                            'contentOptions' => function ($model) {
                                static $b;
                                if ($b != $model->limit['name']) {
                                    $b = $model->limit['name'];
                                    return ['class' => 'gold_limit__column border-top'];
                                } else {
                                    return ['class' => 'gold_limit__column'];
                                }
                            },
                                    'format' => 'html',
                                    'enableSorting' => false,
                                    'value' => function ($model) {
                                static $a;
                                if ($a != $model->limit['name']) {
                                    $a = $model->limit['name'];
                                    return $model->limit['name'];
                                } else {
                                    return '';
                                }
                            }
                                ],
                                [
                                    'attribute' => 'title',
                                    'contentOptions' => ['class' => 'gold_table__row gold_table__title'],
                                    'format' => 'html',
                                    'enableSorting' => false,
                                    'value' => function($model) {
                                return Html::a(Html::encode($model->title), ['video/view', 'alias' => $model->alias]);
                            }
//                        'value' => function ($model) {
//                    $is_buy = \app\modules\video\models\VideoUsr::findOne(['video_id' => $model->id, 'user_id' => \Yii::$app->user->id]);
//                    if ($is_buy != NULL || $model->_isAuthor || \Yii::$app->user->can('administrateVideo')) {
//                        return Html::a(
//                                        $model['title'], ['video/view', 'alias' => $model['alias']], ['class' => 'label label-success large']
//                        );
//                    } else {
//                        return Html::a(
//                                        $model['title'], ['video/view', 'alias' => $model['alias']]
//                        );
//                    }
//                }
                                ],
                                [
                                    'label' => \Yii::t('ru', 'Price'),
                                    'attribute' => 'val',
                                    'contentOptions' => ['class' => 'gold_table__row'],
                                    'format' => 'raw',
                                    'enableSorting' => false,
                                    'value' => function($model) {
                                if ($model->val == NULL) {
                                    return '<span class="not_buyed">' . \Yii::t('ru', 'Free video') . '</span>';
                                } else {
                                    if ($model->_isBuy) {
                                        return '<i class="icon-ok"> </i>' . \Yii::t('ru', 'Buyed video');
                                    } else {
                                        return '<span class="fsp">' . $model->val . '</span>&nbsp;<span class="buyed"></span>';
                                    }
                                }
                            }
                                ],
                                [
                                    'contentOptions' => ['class' => 'gold_table__row gold_table__author'],
                                    'attribute' => 'author_id',
                                    'label' => \Yii::t('ru', 'Author'),
                                    'enableSorting' => false,
                                    'value' => 'user.username',
                                ],
                                [
                                    'contentOptions' => ['class' => 'gold_table__row'],
                                    'attribute' => 'videoparsed.id',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                if ($model->videoparsed['user_id'] === Yii::$app->user->id && $model->videoparsed != NULL) {
                                    return '<i class="icon-check"></i>';
                                } else {
                                    return '<i class="icon-check-empty"></i>';
                                }
                            }
                                ]
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-sm-3">
                        <div class="gold_description">
                            <?= $description_table ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
            $this->endCache();
        }
        ?>