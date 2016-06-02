<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\video\models\VideoType */

$this->title = Yii::t('ru', 'Create Video Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Video Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
