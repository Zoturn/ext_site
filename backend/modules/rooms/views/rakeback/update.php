<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\Rakeback */

$this->title = Yii::t('ru', 'Update {modelClass}: ', [
    'modelClass' => 'Rakeback',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Rakebacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('ru', 'Update');
?>
<div class="rakeback-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
