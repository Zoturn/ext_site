<?php

use yii\helpers\Html;
use himiklab\sortablegrid\SortableGridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\faq\models\FaqCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'FAQ - ' . Yii::t('ru', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('ru', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'sortOrder',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
