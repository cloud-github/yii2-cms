<?php
use frontend\widgets\Alert;

/* @var $this yii\web\View */
/* @var $content string */
?>
<?php $this->beginContent('@frontend/views/layouts/blank.php') ?>
<div class="wrapper">
    <?= $this->render('main-header') ?>
    <?= $this->render('main-sidebar') ?>

    <div class="content-wrapper">
        <section class="content">
            <?= Alert::widget() ?>
            <?= $this->render('content') ?>
            <?= $content ?>
        </section>
    </div>
    <?= $this->render('main-footer') ?>
</div>
<?php $this->endContent() ?>
