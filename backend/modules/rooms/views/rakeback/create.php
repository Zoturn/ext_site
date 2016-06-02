<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\Rakeback */

$this->title = Yii::t('ru', 'Create {modelClass}', [
    'modelClass' => 'Rakeback',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Rakebacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rakeback-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
