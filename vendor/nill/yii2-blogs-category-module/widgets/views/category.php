<?php

use yii\helpers\Html;

if (Yii::$app->request->get('author')) {
    $url = ['author' => Yii::$app->request->get('author')];
} else {
    $url = [];
}
?>

<ul class="unstyled category">
    <?php foreach ($category as $key => $value) { ?>
        <li>
            <div>
                <p class="category_item">
                    <?= Html::a($value['category_name'], ['', 'category' => $value['id']] + $url, ['class' => 'category']) ?> &CenterDot; </p>
            </div>
        </li>
    <?php } ?>
</ul>