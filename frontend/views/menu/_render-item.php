<?php
/**
 * @file      _render-item.php.
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $item common\models\MenuItem */
/* @var $wrapper boolean */

?>

<?= isset($wrapper) ? Html::beginTag('li', ['class' => 'dd-item', 'data-id' => $item->id]) : '' ?>

    <div class="dd-handle"><?= $item->menu_label; ?></div>
    <div class="menu-header clearfix">
        <?= Html::button('<i class="fa fa-caret-down"></i>', [
            'aria-controls' => $item->id,
            'class'         => 'btn btn-flat btn-success btn-detail-menu',
            'data-toggle'   => 'collapse',
            'data-target'   => '#' . $item->id,
        ]); ?>
    </div>

<?= Html::beginTag('div', ['id' => $item->id, 'class' => 'collapse menu-body clearfix', 'aria-expanded' => 'true']); ?>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="form-label">
                    <?= $item->getAttributeLabel('menu_label') ?>
                </label>
                <?= Html::textInput('MenuItem[' . $item->id . '][menu_label]', $item->menu_label, ['class' => 'menu-input form-control input-sm']) ?>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="form-label">
                    <?= $item->getAttributeLabel('menu_url') ?>
                </label>
                <?= Html::textInput('MenuItem[' . $item->id . '][menu_url]', $item->menu_url, ['class' => 'menu-input form-control input-sm']) ?>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label class="form-label">
                    <?= $item->getAttributeLabel('menu_description') ?>
                </label>
                <?= Html::textarea('MenuItem[' . $item->id . '][menu_description]', $item->menu_description, ['class' => 'menu-input form-control input-sm']) ?>
            </div>
        </div>
        <div class="col-sm-12">
            <?= Html::button('<i class="fa fa-trash"></i> ' . 'Remove Menu', [
                'data'  => [
                    'url' => Url::to(['menu/delete-menu-item']),
                    'id'  => $item->id
                ],
                'class' => 'btn-flat btn btn-sm btn-danger menu-delete-menu-item'
            ]) ?>
        </div>
    </div>

<?= Html::endTag('div'); ?>
<?= isset($wrapper) ? Html::endTag('li') : '' ?>