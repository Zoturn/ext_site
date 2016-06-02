<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\faq\models\FaqCategory */

$this->title = Yii::t('ru', 'Create FAQ Category');
$this->params['breadcrumbs'][] = ['label' => 'FAQ ' . Yii::t('ru', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
