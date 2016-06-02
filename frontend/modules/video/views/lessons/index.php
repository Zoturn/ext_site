<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\video\models\LessonsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ru', 'Lesson');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-lessons">
    <div class="video_lessons_content">
        <h4><i class="icon-play-circle"> </i> <?= Html::encode($this->title) ?></h4>
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

        <?php
        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item-lesson'],
            'layout' => "{items}\n{pager}",
            'options'=> ['class' => 'lessons_row'],
            'itemView' => '_index_item',
        ]);
        ?>
    </div>
    <div class="widgets">
        <?= \nill\promos\widgets\Widgetpromos::widget(['status' => 8]) ?>
        <?= nill\recommend\widgets\Widgetrecommend::widget(['status' => 8]) ?>
        <?= nill\links\widgets\Widgetlinks::widget(['status' => 8]) ?>
    </div><!--/.ads-->
</div>
