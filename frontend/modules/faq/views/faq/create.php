<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\faq\models\Faq */

$this->title = Yii::t('ru', 'Create {modelClass}', [
    'modelClass' => 'Faq',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Faqs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
