<?php

use yii\helpers\Html;
use himiklab\sortablegrid\SortableGridView;
use vova07\themes\admin\widgets\Box;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rooms\models\RoomsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ru', 'Rooms');
$this->params['breadcrumbs'][] = $this->title;
$this->params['subtitle'] = yii::t('ru', 'Rooms Panel');
?>
<div class="rooms-index">
    <?php
    $gridId = 'rooms-grid';
    $gridConfig = [
        'id' => $gridId,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'net',
            'alias',
            'snippet:ntext',
            'sortOrder',
            // 'promo',
            // 'logo',
            // 'content:ntext',
            // 'info:ntext',
            // 'instruction:ntext',
            // 'bonus',
        ],
    ];

    $boxButtons = $actions = [];
    $showActions = false;

    if (Yii::$app->user->can('BViewRooms')) {
        $boxButtons[] = '{view}';
        $actions[] = '{view}';
        $showActions = $showActions || true;
    }
    if (Yii::$app->user->can('BCreateRooms')) {
        $boxButtons[] = '{create}';
    }
    if (Yii::$app->user->can('BUpdateRooms')) {
        $actions[] = '{update}';
        $showActions = $showActions || true;
    }
    if (Yii::$app->user->can('BDeleteRooms')) {
        $boxButtons[] = '{batch-delete}';
        $actions[] = '{delete}';
        $showActions = $showActions || true;
    }

    if ($showActions === true) {
        $gridConfig['columns'][] = [
            'class' => ActionColumn::className(),
            'template' => implode(' ', $actions)
        ];
    }
    $boxButtons = !empty($boxButtons) ? implode(' ', $boxButtons) : null;
    ?>
    <div class="row">
        <div class="col-xs-12">
            <?php
            Box::begin(
                    [
                        'title' => $this->params['subtitle'],
                        'bodyOptions' => [
                            'class' => 'table-responsive'
                        ],
                        'buttonsTemplate' => $boxButtons,
                        'grid' => $gridId
                    ]
            );
            ?>
            <?= SortableGridView::widget($gridConfig); ?>
            <?php Box::end(); ?>
        </div>
    </div>
</div>
