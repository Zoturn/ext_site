<?php

use yii\helpers\Html;
use app\modules\rooms\models\RoomsPromo;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\Rooms */
$this->registerMetaTag(['name' => 'description', 'content' => $model->meta], 'description');
$this->title = !empty($model->page_title) ? $model->page_title : $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ru', 'Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;
?>
<div class="rooms-view">
    <div class="row">
        <div class="col-sm-12">
            <div class="room_logo">
                <?= Html::img('/statics/web/rooms/previews/' . $model->logo, []) ?>
                <div class="room_net"><?= \Yii::t('ru', 'Network:') . ' ' . Html::encode($model->net) ?></div>
            </div>
            <h1><?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/rooms.png')[1], ['class' => 'trainings_logo']) ?> 
                <?= Html::encode($this->title) ?></h1>
            <p class="title_description">
                <?= Html::encode($model->snippet); ?>
            </p>
            <div class="room_help">
                <div class="room_arrow"></div>
                <div class="room_help_text">
                    При возникновении вопросов наша служба поддержки всегда готова вам помочь.
                    <div class="room_help_ico">
                        <?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/skype_r.png')[1]) ?>
                            <?php if(($query=nill\statical\models\Statical::findOne(['title'=>'skype']))) { echo $query->text;}?>&nbsp;&nbsp;&nbsp;
                        <?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/mail.png')[1]) ?> 
                        <?php if(($query=nill\statical\models\Statical::findOne(['title'=>'email']))) { echo $query->text;}?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 room__info">
            <span class="room__tab_title">
                Особенности:
            </span>
            <hr>
            <?= $model->info; ?>
        </div>
        <div class="col-sm-12 room__content">
            <span class="room__tab_title">
                Описание:
            </span>
            <hr>
            <?= $model->content; ?>
        </div>
        <div class="col-sm-12 room__promo">
            <span class="room__tab_title">
                Акции:
            </span>
            <hr>
            <?php
            foreach ($model->promo as $value) {
                $promo = RoomsPromo::findOne($value);
                if ($promo) {
                    echo '<div class="promo col-sm-4">';
                    echo Html::a(Html::encode($promo->name), ['promo/view', 'alias' => $promo->alias], ['class' => 'room__promo_title']);
                    echo '<br>';
                    echo $promo->text;
                    echo '<br>';
                    echo '</div>';
                } else { 
                    echo 'Акции отсутствуют';
                }
            }
            ?>
        </div>
        <div class="col-sm-12 room__instruction">
            <span class="room__tab_title">
                Инструкции:
            </span>
            <hr>
            <?= $model->instruction; ?>
        </div>

        <div class="col-sm-12 accounts" id="accounts">
            <span class="room__tab_title">
                Привязать аккаунт:
            </span>
            <hr>
            <?php
            if (!$model->isAccount && !\Yii::$app->user->isGuest) {

                echo '<div class="room__form">';

                $form = ActiveForm::begin([
                            'id' => 'account',
                            'method' => 'post',
                            'action' => ['account'],
                ]);

                echo $form->field($model, 'nickname')->textInput(['class' => 'room__field_nick', 'placeholder' => \Yii::t('ru', 'Nickname')])->label(false);
                ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false); ?>
                <?= Html::submitButton('Привязать', ['class' => 'btn btn-primary'], ['id' => 'sbm']) ?>
                <?php
                ActiveForm::end();
                Pjax::begin(['id' => 'accounts', 'formSelector' => '#account', 'enablePushState' => false]);
                Pjax::end();
                echo '</div><br>';
            } elseif (\Yii::$app->user->isGuest) {
                echo Html::tag('div', Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/login.png')[1])
                        . Html::a('Войдите', ['/login']) . ' или '
                        . Html::a('Зарегистрируйтесь', ['/signup']), ['class' => 'login_please left']);
            } elseif ($model->isAccount && $model->Account_status) {
                echo 'Ник в руме: <b>' . $model->Account_status . '</b>';
            } else {
                echo 'Ваш аккаунт ожидает подтветржения';
            }
            ?>
        </div>

    </div>
</div>
</div>
