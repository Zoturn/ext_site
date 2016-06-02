<?php
use vova07\themes\admin\widgets\Box;

/* @var $this yii\web\View */
/* @var $model app\modules\trainings\models\Trainings */

$this->title = Yii::t('ru', 'Create Trainings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Trainings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['subtitle'] = Yii::t('ru', 'Trainings');

$boxButtons = ['{cancel}'];

if (Yii::$app->user->can('BCreateTrainings')) {
    $boxButtons[] = '{create}';
}
if (Yii::$app->user->can('BDeleteTrainings')) {
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