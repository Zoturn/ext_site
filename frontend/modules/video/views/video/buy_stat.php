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

echo '<br>' . Html::a('<i class="icon-refresh"></i> Обновить', '/video/video/stat/?id=' . $id) . '<br><br>';

// Если привязана тренировка выводим ссылку на статистику
if ($is_training) {
    echo \Yii::t('ru', 'This video has training') . ': ';
    echo Html::a(\Yii::t('ru', 'View stat'), ['/trainings/trainings/stat', 'id' => $is_training]);
}


$this->title = \Yii::t('ru', 'Video Stat');
$this->params['subtitle'] = \Yii::t('ru', 'Buy Panel');
$this->params['subtitle2'] = \Yii::t('ru', 'Gift Panel');
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
            'label' => \Yii::t('ru', 'Cancel'),
            'attribute' => 'cancel',
            'format' => 'html',
            'value' => function ($model) {
                if ($model->fsp < 0 && \Yii::$app->user->can('administrateVideo')) {
                    return Html::a(
                                    \Yii::t('ru', 'Cancel'), ['cancel', 'id' => $model['target_id'], 'target_user_id' => $model['target_user_id']]
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
                    'label' => \Yii::t('ru', 'Cancel'),
                    'attribute' => 'cancel',
                    'format' => 'html',
                    'value' => function ($model) {
                        if ($model->category == 1 && \Yii::$app->user->can('administrateVideo')) {
                            return Html::a(
                                            \Yii::t('ru', 'Cancel'), ['cancel_gift', 'id' => $model['target_id'], 'to_id' => $model['to_id']]
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