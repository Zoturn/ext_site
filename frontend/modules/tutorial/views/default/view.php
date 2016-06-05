<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\tutorial\models\Tutorial */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tutorials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tutorial-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-sm-4">
            <img src="/statics/web/tutorial/previews/<?= $model->preview_url ?>" style="width:370px">
        </div>
        <div class="col-sm-8">

            <?= $model->description_short ?>

            <?= $model->description ?>
        </div>
    </div>
</div>
