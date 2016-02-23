<?php
use yii\helpers\Html;
use frontend\assets\LoginAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

LoginAsset::register($this);
?><?php $this->title ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
         <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    </head>
    <body>
    	<?php $this->beginBody();?>
        	<section class="content">
                <?= Alert::widget() ?>
            	<?php echo $content; ?>
            </section>	
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
