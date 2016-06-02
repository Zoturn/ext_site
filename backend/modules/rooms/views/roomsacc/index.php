<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rooms\models\RoomsAccSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ru', 'Rooms Accs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-acc-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=
        Html::a(Yii::t('ru', 'Create'), ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'room_id',
                'format' => 'html',
                'value' => 'room.title',
            ],
            [
                'attribute' => 'user_id',
                'format' => 'html',
                'value' => 'user.username',
            ],
            'status_id',
            'nickname',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
