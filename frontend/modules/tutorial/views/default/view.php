<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\tutorial\models\Tutorial */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tutorials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tutorial-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <div class="row">
        <div class="col-sm-12">
            <h2>Title:</h2> <?= $model->title ?>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'category_id',
            'description_short:ntext',
            'description:ntext',
            'preview_url:url',
            'status',
            'alias',
            'sort_order',
            'date',
            'views',
        ],
    ]) ?>

</div>
