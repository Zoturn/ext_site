<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\sproba\models\Widget */

$this->title = 'Update Widget: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Widgets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="widget-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
