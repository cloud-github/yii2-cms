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
/* @var $form yii\widgets\ActiveForm */
/* @var $postType common\models\PostType */
/* @var $model common\models\search\Post */
/* @var $user string */

?>

<div id="post-search" class="post-search collapse">

    <?php $form = ActiveForm::begin([
        'action' => isset($user) ? ['index', 'post_type' => $postType->id, 'user' => $user] : ['index', 'post_type' => $postType->id],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'id') ?>

            <?= $form->field($model, 'username') ?>

            <?= $form->field($model, 'post_title') ?>

            <?= $form->field($model, 'post_slug') ?>

            <?= $form->field($model, 'post_excerpt') ?>

            <?= $form->field($model, 'post_content') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'post_modified') ?>

            <?= $form->field($model, 'post_status')->dropDownList($model->getPostStatus(), ['prompt' => '']) ?>

            <?= $form->field($model, 'post_date') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Search'), ['class' => 'btn btn-flat btn-primary'] ?>
        <?= Html::resetButton('Reset'), ['class' => 'btn btn-flat btn-default'] ?>
        <?= Html::button(Html::tag('i', '', ['class' => 'fa fa fa-level-up']), ['class' => 'index-search-button btn btn-flat btn-default', "data-toggle" => "collapse", "data-target" => "#post-search"]); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
