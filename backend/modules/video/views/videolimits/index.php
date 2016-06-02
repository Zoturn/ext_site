<?php

use yii\helpers\Html;
use himiklab\sortablegrid\SortableGridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\video\models\VideoLimitsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ru', 'Video Limits');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-limits-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('ru', 'Create Video Limits'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'type_id',
                'value' => 'type.name'
            ],
            'sortOrder',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
