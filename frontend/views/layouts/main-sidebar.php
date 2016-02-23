<?php
use common\models\PostType;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= Yii::$app->request->BaseUrl . "/images/icon-user.png" ?>" class="img-circle"
                     alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Yii2 CMS</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <?php
        $adminSiteMenu[0] = [
            'label' => Yii::t('yii2-cms', 'MAIN NAVIGATION'),
            'options' => ['class' => 'header'],
            'template' => '{label}',
        ];
        $adminSiteMenu[1] = [
            'label' => Yii::t('yii2-cms', 'Dashboard'),
            'icon' => 'fa fa-dashboard',
            'items' => [
                ['icon' => 'fa fa-circle-o', 'label' => Yii::t('yii2-cms', 'Home'), 'url' => ['/site/index']],
            ],
        ];
        $adminSiteMenu[10] = [
            'label' => Yii::t('yii2-cms', 'Media'),
            'icon' => 'fa fa-picture-o',
            'items' => [
                ['icon' => 'fa fa-circle-o', 'label' => Yii::t('yii2-cms', 'All Media'), 'url' => ['/media/index']],
                [
                    'icon' => 'fa fa-circle-o',
                    'label' => Yii::t('yii2-cms', 'Add New Media'),
                    'url' => ['/media/create'],
                ],
            ],
        ];
        $adminSiteMenu[20] = [
            'label' => Yii::t('yii2-cms', 'Menus'),
            'icon' => 'fa fa-paint-brush',
            'items' => [
                ['icon' => 'fa fa-circle-o', 'label' => Yii::t('yii2-cms', 'Menus'), 'url' => ['/menu/index']],
            ],
        ];
        $adminSiteMenu[30] = [
            'label' => Yii::t('yii2-cms', 'Post Types'),
            'icon' => 'fa fa-files-o',
            'items' => [
                [
                    'icon' => 'fa fa-circle-o',
                    'label' => Yii::t('yii2-cms', 'All Post Types'),
                    'url' => ['/post-type/index'],
                ],
                [
                    'icon' => 'fa fa-circle-o',
                    'label' => Yii::t('yii2-cms', 'Add New Post Type'),
                    'url' => ['/post-type/create'],
                ],
            ],
        ];
        $adminSiteMenu[50] = [
            'label' => Yii::t('yii2-cms', 'Users'),
            'icon' => 'fa fa-user',
            'items' => [
                [
                    'icon' => 'fa fa-circle-o',
                    'label' => Yii::t('yii2-cms', 'All Users'),
                    'url' => ['/user/index'],
                ],
                [
                    'icon' => 'fa fa-circle-o',
                    'label' => Yii::t('yii2-cms', 'Add New User'),
                    'url' => ['/user/create'],
                ],
                [
                    'icon' => 'fa fa-circle-o',
                    'label' => Yii::t('yii2-cms', 'My Profile'),
                    'url' => ['/user/profile'],
                ],
                [
                    'icon' => 'fa fa-circle-o',
                    'label' => Yii::t('yii2-cms', 'Reset Password'),
                    'url' => ['/user/reset-password'],
                ],
            ],
        ];
        $adminSiteMenu = ArrayHelper::merge($adminSiteMenu, PostType::getMenu(2));

        if (isset(Yii::$app->params['adminSiteMenu']) && is_array(Yii::$app->params['adminSiteMenu'])) {
            $adminSiteMenu = ArrayHelper::merge($adminSiteMenu, Yii::$app->params['adminSiteMenu']);
        }

        ksort($adminSiteMenu);
        echo \frontend\widgets\Menu::widget([
            'items' => $adminSiteMenu,
        ]);
        ?>

    </section>
</aside>