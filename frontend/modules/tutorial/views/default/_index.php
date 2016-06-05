<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row blog-item">
    <div class="blog-content">
        <div class="col-sm-2 text-center">
            <a href="/tutorial/default/view/?id=<?= $model->id ?>">
                <h3><?= $model->title; ?></h3>
                <img class="img-responsive img-thumbnail img-circle" src="/statics/web/tutorial/previews/<?= $model->preview_url ?>" style="width:180px">
            </a>
        </div>
        <div class="col-sm-10">
            <?= $model->description_short ?>

            <?= $model->description ?>
            <a class="btn btn-default" href="/tutorial/default/view/?id=<?= $model->id ?>">Подробнее... <i class="icon-angle-right"></i></a>
        </div>
    </div>
</div>