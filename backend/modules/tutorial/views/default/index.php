<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\tutorial\models\TutorialSerch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ru', 'Tutorials');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tutorial-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('ru', 'Create Tutorial'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'category_id',
            'description_short:ntext',
            'description:ntext',
            // 'logo',
            // 'status',
            // 'alias',
            // 'sort_order',
            // 'date',
            // 'views',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
