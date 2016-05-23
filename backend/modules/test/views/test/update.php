<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\test\models\Test */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Test',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="test-update">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= $var ?>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
