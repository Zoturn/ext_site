<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\VideoLimits */

$this->title = Yii::t('ru', 'Update') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Video Limits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('ru', 'Update');
?>
<div class="video-limits-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
