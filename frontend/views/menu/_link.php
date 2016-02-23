<?php
/**
 * @file      _link.php.
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
/* @var $form yii\widgets\ActiveForm */
/* @var $selectedMenu common\models\Menu */
?>

<?php $form = ActiveForm::begin([
    'options' => [
        'class'    => 'panel box box-primary menu-create-menu-item',
        'data-url' => Url::to(['menu/create-menu-item', 'id' => $selectedMenu->id])
    ],
    'action'  => Url::to(['/site/forbidden'])
]); ?>

    <div class="box-header with-border">
        <h4 class="box-title">
            <a href="#link" data-parent="#create-menu-items" data-toggle="collapse" aria-expanded="true">
                <?= 'Menu' ?>
            </a>
        </h4>
    </div>
    <div class="panel-collapse collapse in" id="link">
        <div class="box-body">
            <div class="form-group">
                <?= Html::label('Menu Label', 'menu_item_label', ['class' => 'form-label']); ?>
                <?= Html::textInput('MenuItem[menu_label]', null, ['class' => 'form-control', 'placeholder' => 'Label', 'maxlength' => '255', 'id' => 'menu_item_label']); ?>
            </div>
            <div class="form-group">
                <?= Html::label('Menu URL', 'menu_item_url', ['class' => 'form-label']); ?>
                <?= Html::textInput('MenuItem[menu_url]', null, ['class' => 'form-control', 'placeholder' => 'URL', 'maxlength' => '255', 'id' => 'menu_item_url']); ?>
            </div>
        </div>
        <div class="box-footer">
            <?= Html::hiddenInput('type', 'link'); ?>
            <?= Html::submitButton('Add Menu', ['class' => 'btn btn-flat btn-primary btn-create-menu-item']); ?>
        </div>
    </div>

<?php ActiveForm::end();