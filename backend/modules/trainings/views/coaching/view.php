<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\trainings\models\Coaching */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Coachings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coaching-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('ru', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('ru', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('ru', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'photo',
            'description:ntext',
            'fsp',
            'type_id',
            'limit_id',
            'video_id',
            'link',
            'link_forum',
        ],
    ]) ?>

</div>
