<?php

/**
 * Blogs list view.
 *
 * @var \yii\base\View $this View
 * @var \yii\data\ActiveDataProvider $dataProvider Data provider
 * @var \vova07\blogs\models\backend\BlogSearch $searchModel Search model
 * @var array $statusArray Statuses array
 */
use vova07\themes\admin\widgets\Box;
use yii\grid\ActionColumn;
use yii\grid\CheckboxColumn;
use yii\helpers\Html;
//use vova07\themes\admin\widgets\GridView;
//use yii\jui\DatePicker;
use himiklab\sortablegrid\SortableGridView;

$this->title = yii::t('ru', 'Videos');
$this->params['subtitle'] = yii::t('ru', 'Video Panel');
$this->params['breadcrumbs'] = [
    $this->title
];
$gridId = 'blogs-grid';
$gridConfig = [
    'id' => $gridId,
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'pager' => ['options' => ['class'=>'pagination left']],
    'columns' => [
        [
            'class' => CheckboxColumn::classname()
        ],
//        'id',
        [
            'attribute' => 'title',
            'format' => 'html',
            'value' => function ($model) {
                return Html::a(
                                $model['title'], ['update', 'id' => $model['id']]
                );
            }
                ],
//                'description:ntext',
                'val',
                [
                    'attribute' => 'section',
                    'format' => 'html',
                    'filter' => Html::activeDropDownList(
                            $searchModel, 'section', ['нет', 'да'], ['class' => 'form-control', 'prompt' => 'Выбрать']),
                ],
                'ids',
                'sortOrder',
                [
                    'attribute' => 'date',
                    'format' => 'date',
//                    'filter' => DatePicker::widget(
//                            [
//                                'model' => $searchModel,
//                                'attribute' => 'date',
//                                'options' => [
//                                    'class' => 'form-control'
//                                ],
//                                'clientOptions' => [
//                                    'dateFormat' => 'dd.mm.yy',
//                                ]
//                            ]
//                    )
                ],
                'id_training',
                [
                    'attribute' => 'type_id',
                    'value' => 'type.name'
                ],
                [
                    'attribute' => 'limit_id',
                    'value' => 'limit.name'
                ],
                'tags',
                [
                    'attribute' => 'gp',
                    'format' => 'html',
                    'filter' => Html::activeDropDownList(
                            $searchModel, 'gp', ['нет', 'да'], ['class' => 'form-control', 'prompt' => 'Выбрать']),
                ]
            ]
        ];

        $boxButtons = $actions = [];
        $showActions = false;

        if (Yii::$app->user->can('BCreateVideo')) {
            $boxButtons[] = '{create}';
        }
        if (Yii::$app->user->can('BUpdateVideo')) {
            $actions[] = '{update}';
            $showActions = $showActions || true;
        }
        if (Yii::$app->user->can('BDeleteVideo')) {
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
                            'options'=> [
                                'class' => 'overflow'
                            ],
                            'buttonsTemplate' => $boxButtons,
                            'grid' => $gridId
                        ]
                );
                ?>
                <?= SortableGridView::widget($gridConfig); ?>
                <div class="pagesize">
                    <?php $form = yii\widgets\ActiveForm::begin(['method' => 'GET']); ?>
                    <?= Html::dropDownList('per-page', \Yii::$app->request->get('per-page'), ['10' => '10', '50' => '50', '100'=>'100', '1000'=>Yii::t('ru','All rows')], ['onchange' => 'submit()', 'class' => 'form-control', 'prompt' => Yii::t('ru','Pages')]) ?>
                    <?php yii\widgets\ActiveForm::end(); ?>
                </div>
                <?php Box::end(); ?>
    </div>
</div>