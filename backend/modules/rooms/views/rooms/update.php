<?php

use vova07\themes\admin\widgets\Box;

/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\Rooms */

$this->title = Yii::t('ru', 'Update Rooms') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('ru', 'Update');

$this->params['subtitle'] = Yii::t('ru', 'Update');

$boxButtons = ['{cancel}'];

if (Yii::$app->user->can('BCreateRooms')) {
    $boxButtons[] = '{create}';
}
if (Yii::$app->user->can('BDeleteRooms')) {
    $boxButtons[] = '{delete}';
}
$boxButtons = !empty($boxButtons) ? implode(' ', $boxButtons) : null;
?>
<div class="row">
    <div class="col-sm-12">
        <?php
        $box = Box::begin(
                        [
                            'title' => $this->params['subtitle'],
                            'renderBody' => false,
                            'options' => [
                                'class' => 'box-success'
                            ],
                            'bodyOptions' => [
                                'class' => 'table-responsive'
                            ],
                            'buttonsTemplate' => $boxButtons
                        ]
        );
        ?>

        <?=
        $this->render('_form', [
            'model' => $model,
            'box' => $box,
        ])
        ?>
    </div>
</div>
