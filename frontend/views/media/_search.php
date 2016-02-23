<?php
/**
 * @file      _search.php.
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\Media */
/* @var $form yii\widgets\ActiveForm */
?>

<div id="media-search" class="collapse media-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-sm-6">

            <?= $form->field($model, 'username') ?>

            <?= $form->field($model, 'post_title') ?>

            <?= $form->field($model, 'media_title') ?>

            <?= $form->field($model, 'media_slug') ?>

            <?= $form->field($model, 'media_excerpt') ?>

            <?= $form->field($model, 'media_content') ?>

        </div>
        <div class="col-sm-6">

            <?= $form->field($model, 'media_date') ?>

            <?= $form->field($model, 'media_modified') ?>

            <?= $form->field($model, 'media_mime_type') ?>

       </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii2-cms', 'Search'), ['class' => 'btn-flat btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('yii2-cms', 'Reset'), ['class' => 'btn-flat btn btn-default']) ?>
        <?= Html::button(Html::tag('i', '', ['class' => 'fa fa fa-level-up']), ['class' => 'index-search-button btn btn-flat btn-default', "data-toggle" => "collapse", "data-target" => "#media-search"]); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>