<?php
/**
 * @file      MediaPopupAsset.php.
 * @date      6/4/2015
 * @time      3:43 AM
 * @author    Agiel K. Saputra <13nightevil@gmail.com>
 * @copyright Copyright (c) 2015 WritesDown
 * @license   http://www.yii2-cms
.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Asset bundle for popup media.
 *
 * @package backend\assets
 * @author  Agiel K. Saputra <13nightevil@gmail.com>
 * @since   1.0
 */

class MediaPopupAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $depends = [
        'frontend\assets\AppAsset',
        'yii\jui\JuiAsset',
        'dosamigos\fileupload\FileUploadUIAsset',
    ];
    public function init()
    {
        if (YII_DEBUG) {
            $this->css = ['css/media.popup.css'];
            $this->js = ['js/media.popup.js'];
        } else {
            $this->css = ['css/media.popup.css'];
            $this->js = ['js/media.popup.js'];
        }
    }
}