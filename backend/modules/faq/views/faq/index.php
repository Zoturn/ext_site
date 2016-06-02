<?php

use yii\helpers\Html;
use himiklab\sortablegrid\SortableGridView;
use vova07\themes\admin\widgets\Box;
use yii\grid\ActionColumn;
use yii\helpers\ArrayHelper;
use app\modules\faq\models\FaqCategory;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\faq\models\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ru', 'FAQ');
$this->params['breadcrumbs'][] = $this->title;
$this->params['subtitle'] = yii::t('ru', 'FAQ');
?>
<div class="faq-index">

    <?php
    $gridId = 'faq-grid';
    $gridConfig = [
        'id' => $gridId,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
//            [
//                'attribute' => 'text',
//                'options' => ['style' => 'width:60%'],
//            ],
            [
                'attribute' => 'category_id',
                'filter' => Html::activeDropDownList(
                        $searchModel, 'category_id', ArrayHelper::map(
                                FaqCategory::find()->asArray()->all(), 'id', 'title'), ['class' => 'form-control', 'prompt' => 'Выбрать']),
                'value' => 'category.title',
            ],
            'sortOrder',
        ],
    ];

    $boxButtons = $actions = [];
    $showActions = false;

    if (Yii::$app->user->can('BViewPromo')) {
        $boxButtons[] = '{view}';
        $actions[] = '{view}';
        $showActions = $showActions || true;
    }
    if (Yii::$app->user->can('BCreatePromo')) {
        $boxButtons[] = '{create}';
    }
    if (Yii::$app->user->can('BUpdatePromo')) {
        $actions[] = '{update}';
        $showActions = $showActions || true;
    }
    if (Yii::$app->user->can('BDeletePromo')) {
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
