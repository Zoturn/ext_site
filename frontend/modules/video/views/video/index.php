<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\LinkSorter;
use yii\grid\GridView;

if (Yii::$app->request->get('page')) {
    $this->registerMetaTag(['name' => 'robots', 'content' => 'noindex, follow'], 'robots');
}

$this->registerMetaTag(['name' => 'description', 'content' => Yii::$app->meta->meta_description], 'description');

$this->title = Yii::$app->meta->title;
$this->params['breadcrumbs'][] = Yii::t('ru', 'Video');
?>

<div class="video-index">
    <h1>
        <?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/video.png')[1], ['class' => 'trainings_logo']) ?>
        <?= Yii::t('ru', 'Video') ?>
    </h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
//    echo ListView::widget([
//        'dataProvider' => $dataProvider,
//        'itemOptions' => ['class' => 'item'],
//        'layout' => "{sorter}\n{items}\n{pager}",
//        'itemView' => '_index_item',
//        'sorter' => [
//            'class' => LinkSorter::className(),
//            'attributes' => ['date', 'val'],
//            'options' => ['class' => 'list-inline sorter']
//        ],
//    ]);
    ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'headerRowOptions' => ['class' => 'video_header'],
        'layout' => "{summary}{pager}<br>{items}{pager}",
        'tableOptions' => ['class' => 'table table-striped table-bordered video_table'],
        'rowOptions' => function ($model) {
    if ($model->_isBuy) {
        return ['class' => 'video_column__buyed'];
    }
},
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            [
                //'attribute' => 'preview',
                'contentOptions' => ['class' => 'video_preview__column'],
                'label' => \Yii::t('ru', 'Video'),
                'format' => 'html',
                'value' => function($model) {
            return Html::a(Html::img('/statics/web/video/previews/' . $model->preview, ['class' => 'video_preview']), ['view', 'alias' => $model->alias], ['class'=>'video_title']);
        },
            ],
            [
                'label' => \Yii::t('ru', 'Description'),
                'contentOptions' => ['class' => 'video_content'],
                'attribute' => 'title',
                'format' => 'raw',
                'enableSorting' => false,
                'value' => function ($model) {
//                            $is_buy = \app\modules\video\models\VideoUsr::findOne(['video_id' => $model->id, 'user_id' => \Yii::$app->user->id]);
//                            if ($is_buy != NULL || $model->_isAuthor || \Yii::$app->user->can('administrateVideo')) {
//                                $v = Html::a(
//                                                $model['title'], ['video/view', 'alias' => $model['alias']], ['class' => 'label label-success large']
//                                );
//                            } else {
//                                $v = Html::a(
//                                                $model['title'], ['video/view', 'alias' => $model['alias']]
//                                );
//                            }
            return $this->render('_index_item', ['model' => $model]);
        }
            ],
            [
                'label' => \Yii::t('ru', 'Author'),
                'contentOptions' => ['class' => 'video_author'],
                'headerOptions' => ['class' => 'center'],
                'attribute' => 'user.username',
                'enableSorting' => false,
            ],
            [
                'attribute' => 'date',
                'contentOptions' => ['class' => 'video_date'],
                'headerOptions' => ['class' => 'center'],
                'enableSorting' => false,
                'value' => function($model) {
            return \Yii::$app->formatter->asDate($model->date);
        }
            ],
            [
                'label' => \Yii::t('ru', 'Price'),
                'attribute' => 'val',
                'contentOptions' => ['class' => 'video_fsp'],
                'headerOptions' => ['class' => 'center'],
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
        ],
    ]);
    ?>
</div>