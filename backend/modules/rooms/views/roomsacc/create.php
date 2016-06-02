<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\RoomsAcc */

$this->title = Yii::t('ru', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Rooms Accs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-acc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
