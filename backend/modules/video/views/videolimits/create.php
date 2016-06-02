<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\video\models\VideoLimits */

$this->title = Yii::t('ru', 'Create Video Limits');
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Video Limits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-limits-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
