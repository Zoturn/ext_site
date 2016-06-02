<?php

use vova07\themes\admin\widgets\Box;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video */

$this->title = Yii::t('ru', 'Update Video: ') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('ru', 'Update');

$this->params['subtitle'] = Yii::t('ru', 'Update');

$boxButtons = ['{cancel}'];

if (Yii::$app->user->can('BCreateVideo')) {
    $boxButtons[] = '{create}';
}
if (Yii::$app->user->can('BDeleteVideo')) {
    $boxButtons[] = '{delete}';
}
$boxButtons = !empty($boxButtons) ? implode(' ', $boxButtons) : null;
?>

<div class="row">
    <div class="col-sm-12">
        <?php
        $box = Box::begin(
                        [
                            'title' => $this->params['subtitle']
                            . ' ' .Html::a('', '/video/video/view/?id=' . $model->id, ['class' => 'btn btn-default fa fa-share', 'title' => 'Перейти к материалу', 'target' => '_blank']),
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
