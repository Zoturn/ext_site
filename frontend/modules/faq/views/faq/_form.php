<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\faq\models\FaqCategory;

/* @var $this yii\web\View */
/* @var $model app\modules\faq\models\Faq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?=
    $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(
                    FaqCategory::find()->asArray()->all(), 'id', 'title'), ['prompt' => 'Select category']);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('ru', 'Create') : Yii::t('ru', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
