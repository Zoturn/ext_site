<?php

/**
 * Blog form view.
 *
 * @var \yii\base\View $this View
 * @var \yii\widgets\ActiveForm $form Form
 * @var \vova07\blogs\models\backend\Blog $model Model
 * @var \vova07\themes\admin\widgets\Box $box Box widget instance
 * @var array $statusArray Statuses array
 */
use vova07\blogs\Module;
use vova07\fileapi\Widget as FileAPI;
use vova07\imperavi\Widget as Imperavi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use nill\blogs_category\models\BlogsCategory as Category;
use yii\helpers\ArrayHelper;
?>
<?php $form = ActiveForm::begin(); ?>
<?php $box->beginBody(); ?>
<div class="row">
    <div class="col-sm-12">
        <?= $form->field($model, 'title') ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?= $form->field($model, 'alias') ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <?=
        $form->field($model, 'preview_url')->widget(
                FileAPI::className(), [
            'settings' => [
                'url' => ['/blogs/default/fileapi-upload']
            ],
            'crop' => true,
            'cropResizeWidth' => 100,
            'cropResizeHeight' => 100,
            'jcropSettings' => [
                'aspectRatio' => 5/2,
                'bgColor' => '#ffffff',
                'maxSize' => [200, 800],
                'minSize' => [100, 100],
                'keySupport' => false, // Important param to hide jCrop radio button.
                'selection' => '100%'
            ]
                ]
        )
        ?>
    </div>
    <div class="col-sm-6">
        <?=
        $form->field($model, 'image_url')->widget(
                FileAPI::className(), [
            'settings' => [
                'url' => ['/blogs/default/fileapi-upload']
            ]
                ]
        )
        ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?=
        $form->field($model, 'snippet')->widget(
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
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?=
        $form->field($model, 'content')->widget(
                Imperavi::className(), [
            'settings' => [
                'minHeight' => 300,
                'imageGetJson' => Url::to(['/blogs/default/imperavi-get']),
                'imageUpload' => Url::to(['/blogs/default/imperavi-image-upload']),
                'fileUpload' => Url::to(['/blogs/default/imperavi-file-upload'])
            ]
                ]
        )
        ?>
    </div>
    <div class="col-sm-12">
        <?=
        $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(
                        Category::find()->asArray()->all(), 'id', 'category_name'), ['prompt' => 'Select category']);
        ?>
    </div>
</div>
<?php $box->endBody(); ?>
<?php $box->beginFooter(); ?>
<?=
Html::submitButton(
        $model->isNewRecord ? Module::t('blogs', 'BACKEND_CREATE_SUBMIT') : Module::t(
                        'blogs', 'BACKEND_UPDATE_SUBMIT'
                ), [
    'class' => $model->isNewRecord ? 'btn btn-primary btn-large' : 'btn btn-success btn-large'
        ]
)
?>
<?php $box->endFooter(); ?>
<?php ActiveForm::end(); ?>