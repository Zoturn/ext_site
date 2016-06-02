<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\video\models\VideoUsr */

$this->title = Yii::t('ru', 'Create {modelClass}', [
    'modelClass' => 'Video Usr',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Video Usrs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-usr-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
