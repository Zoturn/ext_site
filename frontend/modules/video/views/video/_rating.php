<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
?>

<div class="rating-box">
    <span><?= \Yii::t('ru', 'Average rating:') ?></span>
    <span class="rtg"><?= $rating ?></span>
    <?php
    if ((!$is_rating && !$val && !Yii::$app->user->isGuest) || (!$is_rating && $is_buy)) {
        ?>
        <div class="rating" id="rating">
            <?=
            Html::a(
                    '', ['rating', 'id' => $id, 'rating' => 1], [
                'class' => 'icon-star',
                'data-pjax' => '#checked_rating']);
            ?>
            <?=
            Html::a(
                    '', ['rating', 'id' => $id, 'rating' => 2], [
                'class' => 'icon-star',
                'data-pjax' => '#checked_rating']);
            ?>
            <?=
            Html::a(
                    '', ['rating', 'id' => $id, 'rating' => 3], [
                'class' => 'icon-star',
                'data-pjax' => '#checked_rating']);
            ?>
            <?=
            Html::a(
                    '', ['rating', 'id' => $id, 'rating' => 4], [
                'class' => 'icon-star',
                'data-pjax' => '#checked_rating']);
            ?>
            <?=
            Html::a(
                    '', ['rating', 'id' => $id, 'rating' => 5], [
                'class' => 'icon-star',
                'data-pjax' => '#checked_rating']);
            ?>
            <?php Pjax::begin(['id' => 'checked_rating', 'linkSelector' => '#rating a', 'enablePushState' => false]); ?>
            <?php Pjax::end(); ?>
        </div>

    <?php } else { ?>
        <br>
        <?php
        $my_rating = (empty($is_rating->rating)) ? 0 : $is_rating->rating;
        for ($i = 0; $i < $my_rating; $i++) {
            echo '<i class="icon-star"> </i>';
        }
        $no_star = 5 - $my_rating;
        for ($i = 0; $i < $no_star; $i++) {
            echo '<i class="icon-star-empty"> </i>';
        }
        ?>
    <?php }
    ?>
</div>