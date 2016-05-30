<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\tutorial\models\TutorialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tutorials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tutorial-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_index',
    ]) ?>
</div>
