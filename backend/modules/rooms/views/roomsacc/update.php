<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\RoomsAcc */

$this->title = Yii::t('ru', 'Update') . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Rooms Accs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('ru', 'Update');
?>
<div class="rooms-acc-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
