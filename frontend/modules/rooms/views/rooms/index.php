<?php

use yii\helpers\Html;
use yii\widgets\ListView;

$this->registerMetaTag(['name' => 'description', 'content' => Yii::$app->meta->meta_description], 'description');

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rooms\models\RoomsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::$app->meta->title;
$this->params['breadcrumbs'][] = Yii::t('ru', 'Rooms');
?>
<div class="rooms-index">

    <h1><?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/rooms.png')[1], ['class' => 'trainings_logo']) ?> 
        <?= Yii::t('ru', 'Rooms'); ?></h1>
    <p class="title_description">
        Здесь собраны все бонусы, бонусные коды и предложения по рейкбэку партнёрских покер-румов freestylepoker.com, 
        превосходящие официальные предложения для обычных игроков. 
        Создайте в выбранном покер-руме аккаунт для игры, используя соответствующий бонусный код, и на ближайший депозит вы получите бонус.
    </p>

    <div class="rooms-best">
        <div class="line-left"></div>
        <h4>
            Лучшие предложения
        </h4>
        <div class="line-right"></div>
    </div>

    <?php
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item-room'],
        'layout' => "{items}\n{pager}",
        'itemView' => function($model) {
    static $i = 0;
    if ($i < 3) {
        $i++;
        return $this->render('_index_item', ['model' => $model]);
    } elseif ($i >= 3) {
//        if ($i == 3) {
//            $i++;
//            return '<div class="rooms-best-correct"><div class="line-left line-left-correct"></div>'
//                    . '<h4>Все предложения</h4><div class="line-right"></div></div>'
//                    . $this->render('_index_item_all', ['model' => $model]);
//        }
        $i++;
        return $this->render('_index_item_all', ['model' => $model]);
    }
},
    ]);
    ?>

</div>
