<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;
use vova07\themes\admin\widgets\Box;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\trainings\models\TrainingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = yii::t('ru', 'Trainings');
$this->params['subtitle'] = yii::t('ru', 'Trainings Panel');
$this->params['breadcrumbs'] = [
    $this->title
];

//echo DatePicker::widget([
//    'name' => 'from_date',
//    'value' => date('d.m.y'),
//    'inline' => true,
//    'clientEvents' => [
//        'click' => 'function () { alert("event change occured."); }'
//    ],
//        'language' => 'ru',
//        'dateFormat' => 'yyyy-MM-dd',
//]);
?>
<div class="trainings-index">

    <?php
    $gridId = 'blogs-grid';
    $gridConfig = [
        'id' => $gridId,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'title',
            'url:url',
            'description:ntext',
            'val',
            [
                'attribute' => 'status_id',
                'format' => 'html',
                'value' => function ($model) {
                    $class = ($model->status_id === $model::STATUS_PUBLISHED) ? 'label-success' : 'label-danger';

                    return '<span class="label ' . $class . '">' . $model->status . '</span>';
                },
                'filter' => Html::activeDropDownList(
                        $searchModel, 'status_id', $statusArray, [
                    'class' => 'form-control',
                    'prompt' => Yii::t('ru', 'BACKEND_PROMPT_STATUS')
                        ]
                )
            ],
        // 'author_id',
        // 'alias',
        // 'date',
        // 'password',
        // 'type_id',
        // 'limit_id',
        // 'time_start:datetime',
        // 'time_end:datetime',
        ],
    ];

    $boxButtons = $actions = [];
    $showActions = false;

    if (Yii::$app->user->can('BViewTrainings')) {
        $boxButtons[] = '{view}';
        $actions[] = '{view}';
        $showActions = $showActions || true;
    }
    if (Yii::$app->user->can('BCreateTrainings')) {
        $boxButtons[] = '{create}';
    }
    if (Yii::$app->user->can('BUpdateTrainings')) {
        $actions[] = '{update}';
        $showActions = $showActions || true;
    }
    if (Yii::$app->user->can('BDeleteTrainings')) {
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
