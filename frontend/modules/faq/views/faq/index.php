<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\faq\models\FaqCategory;
use yii\captcha\Captcha;
use yii\widgets\ActiveForm;
use nill\statical\models\Statical;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\faq\models\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerMetaTag(['name' => 'description', 'content' => Yii::$app->meta->meta_description], 'description');
$this->title = Yii::$app->meta->title;
$this->params['breadcrumbs'][] = Yii::t('ru', 'FAQ')
?>

<div class="faq-index">
    <div class="left">

        <h1><?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/faq.png')[1], ['class' => 'trainings_logo']) ?> 
            <?= Yii::t('ru', 'FAQ') ?></h1>

        <div class="left faq_categories">
            <ul class="unstyled category">
                <?php
                $category = FaqCategory::getCategory();

                foreach ($category as $key => $value) {
                    $options = [
                        'id' => 'category' . $value['id'],
                        'class' => 'category',
                    ];
                    $arrow = [
                        'class' => '',
                    ];
                    if (!Yii::$app->request->get('category') && $value['sortOrder'] == 0) {
                        $options = [
                            'id' => 'category' . $value['id'],
                            'class' => 'category active',
                        ];
                        $arrow = [
                            'class' => 'faq_arrow',
                        ];
                    } elseif (Yii::$app->request->get('category') == $value['id']) {
                        $options = [
                            'id' => 'category' . $value['id'],
                            'class' => 'category active',
                        ];
                        $arrow = [
                            'class' => 'faq_arrow',
                        ];
                    }
                    ?>
                    <li style="position:relative">
                            <!--<a id="category<?= $value['id']; ?>"  href="?category=<?= $value['id']; ?>" class="category"><?= $value['title']; ?></a>-->
                        <?= Html::a($value['title'], '?category=' . $value['id'], $options); ?>
                        <?= Html::tag('div', '', $arrow); ?>
                    </li>
                <?php } ?>
            </ul>
            <?php
            $a_options = ['class' => 'faq_but'];
            if (Yii::$app->request->get('category') == 'q') {
                Html::addCssClass($a_options, 'faq_but_active');
            }
            echo Html::a(Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/faq_q_g.png')[1], ['class' => 'trainings_logo']) .
                    'Задать вопрос', '?category=q', $a_options);
            ?>
        </div>

        <div class="panel-group faq_accordion" id="accordion" role="tablist" aria-multiselectable="true">
            <?php
            $query = nill\fsp\models\backend\Fsprooms::find()->all();
            $collapse = Yii::$app->request->get('collapse');
            $ct_link = Yii::$app->request->get('category')!==NULL?'?category='.Yii::$app->request->get('category').'&collapse=':'?collapse=';

            foreach ($model as $key => $value) {
                static $i;
                $i++;
                ?>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading<?= $value['id']; ?>">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" class="collapse-a <?php
                            if ($collapse && $value['id'] == $collapse) {
                            } else if ($i > 1) {
                                echo 'collapsed';
                            }
                            ?>" data-parent="#accordion" href="#collapse<?= $value['id']; ?>" aria-expanded="true" aria-controls="collapse<?= $value['id']; ?>">
                                   <?= $value['title']; ?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse<?= $value['id']; ?>" name="collapse<?= $value['id']; ?>" class="panel-collapse collapse <?php
                    $collapse = Yii::$app->request->get('collapse');
                    if ($i == 1 && !$collapse) {
                        echo 'in';
                    } else if ($value['id'] == $collapse) {
                        echo 'in';
                    }
                    ?>" role="tabpanel" aria-labelledby="heading<?= $value['id']; ?>">
                        <div class="panel-body">
                            <?= $value['text']; ?>
                            <a class="ct_link" href="#">Получить ссылку</a>
                            <div class="select-code"><?= Url::home(true) . 'help/' . $ct_link . $value['id']; ?></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div><!-- COLLAPSE -->

        <?php if (Yii::$app->request->get('category') == 'q') : ?>
            <div class="faq_form">
                <?php
                $form = ActiveForm::begin();
                ?>
                <?=
                $form->field($model_form, 'subject')->radioList([
                    'Общее' => 'Общее',
                    'Обучение' => 'Обучение',
                    'Магазин' => 'Магазин',
                    'Покер-румы' => 'Покер-румы',
                    'Баллы F$P' => 'Баллы F$P',
                        ], ['separator' => '', 'class' => 'faq_radiolist']);
                ?>
                <?= $form->field($model_form, 'name')->hiddenInput(['value' => 'Robot:FAQ'])->label(false); ?>
                <?= $form->field($model_form, 'email') ?>
                <?= $form->field($model_form, 'body')->textArea(['rows' => 6]) ?>
                <?=
                $form->field($model_form, 'verifyCode')->widget(
                        Captcha::className(), [
                    'captchaAction' => '/site/default/captcha',
                    'options' => ['class' => 'form-control'],
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-9">{input}</div></div>',
                        ]
                )
                ?>

                <?= Html::submitButton(Yii::t('ru', 'Отправить заявку'), ['class' => 'btn btn-primary btn-lg']) ?>
                <?php
                ActiveForm::end();
                $js = '$(document).ready(function(){'
                        . '$(".faq_accordion").hide();'
                        . '})';
                $this->registerJs($js);
                ?>
            </div>
        <?php endif; ?>

    </div>
    <div class="faq_right right">
        <h4><?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/faq_contacts.png')[1], ['class' => 'trainings_logo']) ?> 
            <?= Yii::t('ru', 'Contacts') ?></h4>
        <hr class="hr">
        <span class="faq_t">E-mail:</span>
        support@freestylepoker.com
        <a href="?category=q" class="faq_quest"><?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/faq_q.png')[1], ['class' => 'trainings_logo']) ?>
            Задать вопрос
        </a>
        <span class="faq_t">Skype:</span>
        <!--        ev.freestylepoker-->
        <?= Statical::findOne(['title' => 'skype'])->text; ?>
        <a href="<?= Statical::findOne(['title' => 'skype'])->alias; ?>" class="faq_quest"><?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/faq_skype.png')[1], ['class' => 'trainings_logo']) ?>
            Связаться с нами
        </a>
        <hr class="hr">
        <div class="widgets">
            <?= \nill\promos\widgets\Widgetpromos::widget(['status' => 9]) ?>
            <?= nill\recommend\widgets\Widgetrecommend::widget(['status' => 9]) ?>
            <?= nill\links\widgets\Widgetlinks::widget(['status' => 9]) ?>
        </div><!--/.ads-->
    </div>
</div>
<style>
    div.select-code {
        display: none;
    }
</style>
<?php 
$js = "$('a.ct_link').click(function() { $(this).next('div.select-code').slideDown(); return false; });
$('div.select-code').click(function() {
 var e=this; 
 if(window.getSelection){ 
 var s=window.getSelection(); 
 if(s.setBaseAndExtent){ 
 s.setBaseAndExtent(e,0,e,e.innerText.length-1); 
 }else{ 
 var r=document.createRange(); 
 r.selectNodeContents(e); 
 s.removeAllRanges(); 
 s.addRange(r);} 
 }else if(document.getSelection){ 
 var s=document.getSelection(); 
 var r=document.createRange(); 
 r.selectNodeContents(e); 
 s.removeAllRanges(); 
 s.addRange(r); 
 }else if(document.selection){ 
 var r=document.body.createTextRange(); 
 r.moveToElementText(e); 
 r.select();}
});";
    Yii::$app->view->registerJs($js);
        ?>