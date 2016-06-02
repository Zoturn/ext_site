<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\trainings\models\CoachingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ru', 'Coachings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coaching-index">
    <div class="left">
        <h4> <?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/trainers.png')[1], ['class' => 'trainings_logo']) ?>
            <?= Html::encode($this->title) ?></h4>
        Лучшие тренера нашей школы готовы передать свои знания! Выбери кто из них тебе больше подходит.
        <br><br>
        <?=
        GridView::widget([
            'id' => 'trainings',
            'headerRowOptions' => ['class' => 'coaching_header'],
            'dataProvider' => $dataProvider,
            'layout' => "{items}",
            'rowOptions' => function ($model) {
        return ['class' => 'coaching_row'];
    },
            'tableOptions' => ['class' => 'coaching_table'],
            'columns' => [
                [
                    'attribute' => 'photo',
                    'enableSorting' => false,
                    'headerOptions' => ['class' => 'coaching_table__photo'],
                    'contentOptions' => ['class' => 'coaching_table__photo'],
                    'label' => \Yii::t('ru', 'Trainer'),
                    'format' => 'html',
                    'value' => function($model) {
                return Html::img('/statics/web/coaching/previews/' . $model->photo, ['class' => 'img_coaching']);
            }
                ],
                [
                    'attribute' => 'user_id',
                    'label' => '',
                    'headerOptions' => ['class' => 'coaching_table__info'],
                    'contentOptions' => ['class' => 'coaching_table__info'],
                    'format' => 'html',
                    'value' => function($model) {
                $video = app\modules\video\models\Video::findOne($model->video_id);
                return '<span class="coaching_name">' . $model->user->username . '</span>'
                        . '<br>'
                        . '<span class="coaching_desc">' . $model->description . '</span>'
                        . '<br>'
                        . Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/video.png')[1], ['class' => 'trainings_logo'])
                        . Html::a(\Yii::t('ru', 'Intro video'), [empty($video->alias) ? '' : '/video/' . $video->alias], ['class' => 'coaching_link'])
                        . Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/c_forum.png')[1], ['class' => 'trainings_logo'])
                        . Html::a(\Yii::t('ru', 'Forum'), $model->link_forum, ['class' => 'coaching_link'])
                        . Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/video_gr.png')[1], ['class' => 'trainings_logo'])
                        . Html::a(\Yii::t('ru', 'All videos'), '/video/?author=' . $model->user->id, ['class' => 'coaching_link'])

                        //. Html::a('Link', $model->link)
                        . ' ';
            },
                ],
                [
                    'attribute' => 'type_id',
                    'enableSorting' => false,
                    'headerOptions' => ['class' => 'coaching_table__type'],
                    'contentOptions' => ['class' => 'coaching_table__type'],
                    'label' => \Yii::t('ru', 'Specialization'),
                    'format' => 'html',
                    'value' => function($model) {
                return $model->type->name
                        . ' '
                        . $model->limit->name;
            },
                ],
                [
                    'label' => \Yii::t('ru', 'fsp/h'),
                    'enableSorting' => false,
                    'headerOptions' => ['class' => 'coaching_table__fsp'],
                    'contentOptions' => ['class' => 'coaching_table__fsp'],
                    'format' => 'html',
                    'attribute' => 'fsp',
                    'value' => function ($model) {
                return '<span class="fsp">'
                        . $model->fsp
                        . Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/fsp.png')[1], ['class' => 'fsp'])
                        . '</span>';
            }
                ],
            ],
        ]);
        ?>
    </div>
    <div class="widgets">
        <h4><?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/info.png')[1], ['class' => 'ico']) ?> ИНФОРМАЦИЯ</h4>
        <hr class="hr_">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        <br>
        <br>
        <?= \nill\promos\widgets\Widgetpromos::widget(['status' => 7]) ?>
        <?= nill\recommend\widgets\Widgetrecommend::widget(['status' => 7]) ?>
        <?= nill\links\widgets\Widgetlinks::widget(['status' => 7]) ?>
    </div>
</div>
