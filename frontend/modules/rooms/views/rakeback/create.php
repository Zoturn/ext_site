<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\rooms\models\Rakeback */
$this->registerMetaTag(['name' => 'description', 'content' => Yii::$app->meta->meta_description], 'description');

$this->title = Yii::$app->meta->title;

$this->params['breadcrumbs'][] = Yii::t('ru', 'Create Rakeback');
?>

<?php if (Yii::$app->session->hasFlash('success')): ?>

    <div class="flash-success">
        <?php echo 'Вы можете отправлять не более одной заявки в 10 минут'; ?>
    </div>

<?php else: ?>

    <div class="rakeback-create">
        <h1> <?= Html::img(Yii::$app->assetManager->publish('@vova07/themes/site/assets/images/rakeback.png')[1], ['class' => 'section_logo']) ?>
            <?= Yii::t('ru', 'Create Rakeback'); ?></h1>
        <p>
            Во всех покер румах, с каждого разыгрываемого банка взимается комиссия - рэйк. 
            Так за месяц игры может набежать солидная сумма. 
            Часть рейка мы возвращаем, эта часть называется рэйкбек.
        </p>
        <hr>
        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>
    </div>
<?php endif; ?>