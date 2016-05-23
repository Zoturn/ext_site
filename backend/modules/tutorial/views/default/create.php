<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\tutorial\models\Tutorial */

$this->title = Yii::t('ru', 'Create Tutorial');
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Tutorials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tutorial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
