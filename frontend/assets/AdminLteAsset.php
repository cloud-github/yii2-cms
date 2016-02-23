<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;
use yii\web\AssetBundle;

/**
 * @author Mahesh Joshi <mahesh@bentraytech.com>
 * @since 2.0
 */

class AdminLteAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/admin-lte/dist';
    public $css = [
        'css/AdminLTE.css',
        'css/skins/_all-skins.css',
    ];
    public $js = ['js/app.js'];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        '\rmrevin\yii\fontawesome\AssetBundle'
    ];
}
