<?php
/**
 * @file      _select.php.
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $availableMenu [] */
/* @var $selectedMenu common\models\Menu */

$form = ActiveForm::begin([
    'action' => Url::to(['/menu/index']),
    'method' => 'post'
]); ?>

    <div class="menu-select_menu">

               <div class="col-sm-8 no-padding"><?= Html::dropDownList('id', isset($selectedMenu) ? $selectedMenu->id : null, $availableMenu, ['id' => 'select-menu', 'class' => 'form-control']); ?></div>
               <div class="col-sm-4">
                   <?= Html::submitButton('Select Menu', ['class' => 'btn btn-flat btn-primary submit-button']); ?>
                   <?= Html::button('<i class="fa fa-trash"></i> ' . 'Delete', [
                       'id'    => 'menu-delete-menu',
                       'class' => 'btn btn-flat btn-danger',
                       'data'  => [
                           'message' => 'Are you sure you want to delete this item?',
                           'url'     => Url::to(['/menu/delete']),
                           'error'   => 'At least select one of the menu',
                       ],
                   ]) ?>
               </div>
        </div>


<?php ActiveForm::end();