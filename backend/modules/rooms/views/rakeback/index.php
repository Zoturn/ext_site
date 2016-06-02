<?php

use yii\helpers\Html;
use yii\grid\GridView;
use vova07\themes\admin\widgets\Box;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\rooms\models\RakebackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ru', 'Rakeback');
$this->params['breadcrumbs'][] = $this->title;
$this->params['subtitle'] = yii::t('ru', 'Rakeback Panel');
?>
<div class="rakeback-index">

    <?php
    $gridId = 'rakeback-grid';
    $gridConfig = [
        'id' => $gridId,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'phone',
            'skype',
            'email:email',
            'status_id',
        // 'comment',
        // 'type_poker:ntext',
        // 'fsp',
        // 'rooms',
        // 'about:ntext',
        // 'link',
        ],
    ];

    $boxButtons = $actions = [];
    $showActions = false;

    if (Yii::$app->user->can('BViewRooms')) {
        $boxButtons[] = '{view}';
        $actions[] = '{view}';
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
            <?= GridView::widget($gridConfig); ?>
            <?php Box::end(); ?>
        </div>
    </div>
</div>
