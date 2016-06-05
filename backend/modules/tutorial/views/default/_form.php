<?php

use vova07\fileapi\Widget as FileAPI;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget as Imperavi;
use yii\helpers\Url;
use yii\jui\DatePicker;
use app\modules\tutorial\models\CategotyOfTutorials as Category;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\tutorial\models\Tutorial */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tutorial-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'preview_url')->widget(
            FileAPI::className(), [
        'settings' => [
            'url' => ['/tutorial/default/fileapi-upload']
        ]
            ]
    )
    ?>

    <?=
    $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(
                    Category::find()->asArray()->all(), 'id', 'title'), ['prompt' => 'Select category']);
    ?>

    <?= $form->field($model, 'description_short')->textarea(['rows' => 6]) ?>

    <?=
    $form->field($model, 'description')->widget(
            Imperavi::className(), [
        'settings' => [
            'minHeight' => 200,
            'imageGetJson' => Url::to(['/blogs/default/imperavi-get']),
            'imageUpload' => Url::to(['/blogs/default/imperavi-image-upload']),
            'fileUpload' => Url::to(['/blogs/default/imperavi-file-upload'])
        ]
            ]
    )
    ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'date')->widget(
            DatePicker::className(), [
        'options' => [
            'class' => 'form-control'
        ],
        'clientOptions' => [
            'dateFormat' => 'dd.mm.yy',
            'changeMonth' => true,
            'changeYear' => true
        ]
            ]
    );
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
