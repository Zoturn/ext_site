<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\Rakeback */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Rakebacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rakeback-view">

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
            'name',
            'phone',
            'skype',
            'email:email',
            'comment',
            'type_poker:ntext',
            'fsp',
            'rooms',
            'about:ntext',
            'link',
            'status_id',
        ],
    ]) ?>

</div>
