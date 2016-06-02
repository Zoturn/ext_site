<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\select2\Widget;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\modules\video\models\Video */
$this->registerMetaTag(['name' => 'description', 'content' => $model->meta], 'description');
//$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

echo Html::a($model['title'], '#_' . $model->alias, [
    'class' => 'training_title',
    'id' => '_' . $model->alias,
//    'data-toggle' => 'modal',
//    'data-target' => '#training' . $model->id
]) . '<br>' . \Yii::t('ru', 'Trainer') . ': ' . Html::a(
        $model->user->username, ['trainings/view', 'alias' => $model['alias']], ['class' => 'training_author']
);
Modal::begin([
    'header' => "<h4>{$model->title}</h4>",
    'id' => 'training' . $model->id,
    'options' => ['class' => 'training-modal fade modal'],
        //'toggleButton' => ['label' => \Yii::t('ru', 'Buy'), 'class' => 'training_btn btn btn-primary buy'],
]);
?>

<div class="training_line overflow">
    <div class="b_r left">
        <?=
        '<div class="">' . \Yii::$app->formatter->asDate($model->date) . '</div>';
        ?>
    </div>
    <div class="b_r left ">
        <?=
        '<div class="trainings_time">' . $model->time_start . ' - '
        . $model->time_end . ' МСК</div>'
        ?>
    </div>
    <div class="left">
        <?= '<span class="cl">' . \Yii::t('ru', 'Type') . ':</span> ' . $model->type["name"] . ' ' . $model->limit["name"] ?></div>
    <div class="right centered-text">
        <?php
        if (\Yii::$app->user->isGuest) {
            echo '';
        } elseif (!$model->val) {
            echo '';
        } else if (($model->_isBuy == true || $model->_isAuthor || \Yii::$app->user->can('administrateTraining')) && !empty($model->password)) {
            echo '<a class="training_btn_go">' . $model->password . ' '
            . '<i class="icon-chevron-sign-right"></i> </a>';
        } elseif (!$model->_isBuy && $model->val) {
            ?>
            <span class="cl"><?= \Yii::t('ru', 'Price') ?>: </span>
            <?php
            echo $val = (!empty($model->val)) ? $model->val
            . ' &nbsp;<span class="buyed"></span> <br>' : \Yii::t('ru', 'Free video')
            ?>
            <?php
            $options = [
                'class' => 'training_btn btn btn-primary buy',
                'data-toggle' => 'modal',
                'data-target' => '#myModal' . $model->id,
                'title' => 'Купить доступ к просмотру'
            ];
            echo Html::button(\Yii::t('ru', 'Buy'), $options);
        }
        ?>
    </div>
</div>
<div class="training_description">
    <?= $model->description ?> 
    <div class="gold">

        <br><?= $model->message ?>
    </div>
    <div class="gold">
        <?php
//                            $options = [
//                                'class' => 'btn btn-primary',
//                                'data-toggle' => 'modal',
//                                'data-target' => '#myModal',
//                                'title' => 'Купить доступ к просмотру'
//                            ];
//
//                            if ($model->_isBuy == true || $model->_isAuthor || \Yii::$app->user->can('administrateTraining')) {
//                                Html::addCssClass($options, 'hide');
//                                echo 'Ссылка: ' . $model->url;
//                            }
//
//                            if (empty($model->val)) {
//                                echo 'Ссылка: ' . $model->url;
//                            }
//
//                            if (Yii::$app->user->isGuest) {
//                                Html::addCssClass($options, 'disabled');
//                            }
//
//                            if (!empty($model->val)) {
//                                echo Html::button('Купить', $options);
//                            }
        ?>
    </div>
    <div class="training_footer ofw">
        <div class="left trainer">
            <?php
            $content = \Yii::t('ru', 'Trainer') . ': ' . Html::a(
                            $model->user->username, '/video/?author=' . $model->author_id);
            echo Html::tag('div', $content, ['class' => 'training_author']);
            ?>
        </div>
        <?php
        if (\Yii::$app->user->isGuest) {
            echo Html::tag('div', Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/login.png')[1])
                    . Html::a('Войдите', ['/login']) . ' или '
                    . Html::a('Зарегистрируйтесь', ['/signup']), ['class' => 'login_please right']);
        } elseif ($model->_isBuy == true || $model->_isAuthor || \Yii::$app->user->can('administrateTraining') || empty($model->val)) {
            echo Html::a(\Yii::t('ru', 'Go to training'), $model->url, ['class' => 'training_but right']);
        } else {
            ?>
        <?php } ?>
    </div> 
    <?php
    if (Yii::$app->user->can('gift')) {
        $gift_form = ActiveForm::begin([
                    'id' => 'gift' . $model->id,
                    'method' => 'post',
                    'action' => ['gift'],
                    'options' => ['class' => 'gift_form'],
        ]);

        echo $gift_form->field($model, 'author')->widget(Widget::className(), [
            'options' => [
                'prompt' => \Yii::t('ru', 'Select user...'),
                'id' => 'gift_' . $model->id,
            ],
            'settings' => [
                'minimumInputLength' => 3,
                'width' => '100%',
            ],
            'items' => $model->AllUsers,
        ])->label(\Yii::t('ru', 'Make the gift'));
        ?>
        <?= $gift_form->field($model, 'id')->hiddenInput()->label(false); ?>
        <?= Html::submitButton('Подарить', ['class' => 'btn btn-primary'], ['id' => 'gift-sbm']) ?>
        <div class="gift_message" id="gifter<?= $model->id ?>"></div>
        <?php
        ActiveForm::end();
        Pjax::begin(['id' => 'gifter' . $model->id, 'formSelector' => '#gift' . $model->id, 'enablePushState' => false]);
        Pjax::end();
    }
    if (Yii::$app->user->can('administrateTrainings') || $model->_isAuthor) {
        echo Html::a('Статистика', ['stat', 'id' => $model->id], ['class' => 'stat right', 'target' => '_blank']);
    }
    ?>
</div>
<?php Modal::end(); ?>

<?php
$js = "
        $(document).ready(function () {
        
        $('.close').click(function(){
            location.hash='';
        });
        
        $('#training" . $model->id . "').keyup(function(event){
            if (event.keyCode == 27) {
                location.hash='';
            }
        });

        $('#_" . $model->alias . "').click(function(){
            $('#training" . $model->id . "').modal();
            });
        $(''+location.hash).click();
        });";

$this->registerJs($js);
?>

<!-- Modal -->
<div class="modal fade" id="myModal<?= $model->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Купить видео "<?= $model->title ?>"</h4>
            </div>
            <div class="modal-body">
                Вы действительно желаете купить это видео?
            </div>
            <div class="modal-footer">
                <?php
                $form = ActiveForm::begin([
                            'method' => 'post',
                            'action' => ['view', 'id' => $model->id],
                ]);
                echo $form->field($model, 'val')->hiddenInput()->label(false);
                echo Html::hiddenInput('date', \Yii::$app->request->get('date'));
                echo Html::button(\Yii::t('ru', 'Cancel'), ['class' => 'btn btn-default', 'data-dismiss' => 'modal']);
                echo Html::submitButton(\Yii::t('ru', 'Buy'), ['class' => 'btn btn-primary']);
                ActiveForm::end();
                ?>
            </div>
        </div>
    </div>
</div>