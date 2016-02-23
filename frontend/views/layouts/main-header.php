<?php
/**
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
?>
<header class="main-header">
    <a href="<?= Yii::$app->urlManagerFront->createUrl(['/site/index']) ?>" class="logo">
        <span class="logo-mini"><?= Html::img(Yii::getAlias('@web/img/logo-mini.png')) ?></span>
        <span class="logo-lg"><b>Yii2</b>CMS</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <?php if (!Yii::$app->user->isGuest): ?>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                            <span class="hidden-xs"><?= Yii::$app->user->identity->username ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <p>
                                    <?= Yii::$app->user->identity->username ?>
                                    <small>
                                        <?= Yii::t('yii2-cms', 'Member since {date}', [
                                            'date' => Yii::$app
                                                ->formatter
                                                ->asDate(Yii::$app->user->identity->created_at, 'php:F d, Y'),
                                        ]) ?>
                                    </small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <?= Html::a(
                                        Yii::t('yii2-cms', 'Profile'),
                                        ['/user/profile'],
                                        ['class' => 'btn btn-default btn-flat']
                                    ) ?>
                                </div>
                                <div class="pull-right">
                                    <?= Html::a(
                                        Yii::t('yii2-cms', 'Sign Out'),
                                        ['/site/logout'],
                                        ['class' => 'btn btn-default btn-flat', 'data-method' => 'post']
                                    ) ?>
                                </div>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
</header>
