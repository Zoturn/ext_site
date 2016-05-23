<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use app\modules\test\models\Test as Tt;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\test\models\TestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Тестовый модуль');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-index">
    
    <?php $text = Tt::findOne(1);
        echo 'Имя: ' . $text['name']; ?>
    
    

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_test',
    ]);
    ?>
</div>
