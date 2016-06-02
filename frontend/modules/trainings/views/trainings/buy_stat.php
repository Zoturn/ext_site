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
use vova07\themes\admin\widgets\GridView;
use yii\helpers\Html;

$this->title = yii::t('ru', 'Training Stat');
$this->params['subtitle'] = yii::t('ru', 'Buy Panel');
$this->params['subtitle2'] = yii::t('ru', 'Gift Panel');
$this->params['breadcrumbs'] = [
    $this->title
];
$gridId = 'blogs-grid';
$gridConfig = [
    'id' => $gridId,
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
    'columns' => [
        [
            'attribute' => 'user_id',
            'label' => 'Выполнено',
            'value' => function ($model) {
                return empty($model['user_id']) ? 'Site' : $model['user_id'];
            },
        ],
        ['attribute' => 'target_user_id', 'label' => 'Пользователь', 'value' => 'targetuser.username'],
        ['attribute' => 'author_id', 'label' => 'Автор', 'value' => 'author.username'],
        ['attribute' => 'target_id', 'label' => 'ID Цели', 'value' => 'target_id'],
        [
            'label' => \Yii::t('ru', 'F$P'),
            'attribute' => 'fsp'
        ],
        'comment',
        [
            'attribute' => 'date',
            'format' => 'datetime',
        ],
        [
            'attribute' => 'cancel',
            'format' => 'html',
            'value' => function ($model) {
                if ($model->fsp < 0 && \Yii::$app->user->can('administrateTrainings')) {
                    return Html::a(
                                    Yii::t('ru', 'Cancel'), ['cancel', 'id' => $model['target_id'], 'target_user_id' => $model['target_user_id']]
                    );
                } else {
                    return '';
                }
            }
                ],
            ]
        ];


        $gridId2 = 'gift-grid';
        $gridConfig2 = [
            'id' => $gridId2,
            'dataProvider' => $dataProvider_gift,
            //'filterModel' => $searchModel,
            'columns' => [
                'user.username',
                'comment',
                [
                    'attribute' => 'date',
                    'format' => 'datetime',
                ],
                [
                    'label' => \Yii::t('ru', 'Who made gift'),
                    'attribute' => 'from_id',
                    'format' => 'html',
                    'value' => 'from.username'
                ],
                [
                    'attribute' => 'cancel',
                    'format' => 'html',
                    'value' => function ($model) {
                        if ($model->category == 1 && \Yii::$app->user->can('administrateTrainings')) {
                            return Html::a(
                                            Yii::t('ru', 'Cancel'), ['cancel_gift', 'id' => $model['target_id'], 'to_id' => $model['to_id']]
                            );
                        } else {
                            return '';
                        }
                    }
                        ],
                    ]
                ];
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
                                    'grid' => $gridId
                                ]
                        );
                        ?>
                        <?= GridView::widget($gridConfig); ?>
                        <?php Box::end(); ?>
                    </div>
                    <div class="col-xs-12">
                        <?php
                        Box::begin(
                                [
                                    'title' => $this->params['subtitle2'],
                                    'bodyOptions' => [
                                        'class' => 'table-responsive'
                                    ],
                                    'grid' => $gridId2
                                ]
                        );
                        ?>
                        <?= GridView::widget($gridConfig2); ?>
                        <?php Box::end(); ?>
    </div>
</div>