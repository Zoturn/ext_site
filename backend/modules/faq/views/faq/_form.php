<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\faq\models\FaqCategory;
use vova07\imperavi\Widget as Imperavi;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\faq\models\Faq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>

    <?=
    $form->field($model, 'text')->widget(
            Imperavi::className(), [
        'settings' => [
            'plugins'=> ['fontsize'],
            'minHeight' => 70,
            'imageGetJson' => Url::to(['/faq/faq/imperavi-get']),
            'imageUpload' => Url::to(['/faq/faq/imperavi-image-upload']),
        ]
            ]
    )
    ?>

    <?=
    $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(
                    FaqCategory::find()->asArray()->all(), 'id', 'title'), ['prompt' => Yii::t('ru', 'Select category')]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('ru', 'Create') : Yii::t('ru', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
