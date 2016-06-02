<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\trainings\models\Coaching */

$this->title = Yii::t('ru', 'Create Coaching');
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Coachings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coaching-create row">
    <div class="col-sm-12">
        <div class="box box-success">
        <div><br></div>
            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>
        </div>
    </div>
</div>
