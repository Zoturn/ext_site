<?php

use yii\grid\GridView;
use yii\helpers\Html;
use nill\slider\widgets\Widgetslider;
use nill\bankroll\widgets\Widgetbankroll;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rooms\models\RoomsPromoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ru', 'Rooms Promos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-promo-index">

    <h4> <?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/rooms.png')[1], ['class' => 'section_logo']) ?>
        <?= Html::encode($this->title) ?></h4>
    <p>
        Здесь собраны все акции покер-румов
    </p>
    <div class="row">
        <div class="col-sm-12">
            <?= Widgetslider::widget(['status' => 'on']) ?>
        </div>
    </div>
    <div class="widgets row">
        <br>
        <?= \nill\promos\widgets\Widgetpromos::widget(['status' => 5]) ?>
        <?= nill\recommend\widgets\Widgetrecommend::widget(['status' => 5]) ?>
        <?= nill\links\widgets\Widgetlinks::widget(['status' => 5]) ?>
    </div><!--/.ads-->

    <div>
        <?= Widgetbankroll::widget(['status' => 'on']) ?>

        <div class="promo_all_title">Все акции</div>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "{items}",
            'rowOptions' => function ($model) {
                return ['class' => 'roomspromo_row'];
            },
                    'showHeader' => false,
                    'tableOptions' => ['class' => 'promo_table'],
                    'columns' => [
                        [
                            'attribute' => 'img',
                            'format' => 'raw',
                            'contentOptions' => ['class' => 'roomspromo_row_img'],
                            'value' => function ($model) {
                        return Html::a(Html::img('/statics/web/rooms/previews/' . $model->img, ['style' => 'width:125px']), $model->alias . '/');
                    }
                        ],
                        [
                            'attribute' => 'text',
                            'format' => 'raw',
                            'contentOptions' => ['class' => 'roomspromo_row_text'],
                            'value' => function ($model) {
                        return Html::a($model->name, $model->alias . '/', ['class' => 'roomspromo_row_name'])
                                . '<br>'
                                . iconv_substr($model->text, 0, 200, 'UTF-8') . '...';
                    }
                        ],
                        [
                            'label' => 'button',
                            'format' => 'raw',
                            'contentOptions' => ['class' => 'roomspromo_row_but'],
                            'value' => function ($model) {
                        return Html::a('<div class="but_arr"></div>', $model->alias . '/', ['class' => 'roomspromo_row_name']);
                    }
                        ],
                    ],
                ]);
                ?>
    </div>
</div>
