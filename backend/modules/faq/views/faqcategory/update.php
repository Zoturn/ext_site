<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\faq\models\FaqCategory */

$this->title = Yii::t('ru', 'Update FAQ Category') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'FAQ ' . Yii::t('ru', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('ru', 'Update');
?>
<div class="faq-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
