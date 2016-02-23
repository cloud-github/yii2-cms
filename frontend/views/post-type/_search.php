<?php
/**
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\PostType */
/* @var $form yii\widgets\ActiveForm */
?>

<div id="post-type-search" class="post-type-search collapse">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]) ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'post_type_name') ?>

            <?= $form->field($model, 'post_type_slug') ?>

            <?= $form->field($model, 'post_type_description') ?>

        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'post_type_sn') ?>

            <?= $form->field($model, 'post_type_pn') ?>

            <?= $form->field($model, 'post_type_smb')->dropDownList($model->getSmb(), ['prompt' => '']) ?>

        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii2-cms', 'Search'), ['class' => 'btn btn-flat btn-primary']) ?>

        <?= Html::resetButton(Yii::t('yii2-cms', 'Reset'), ['class' => 'btn btn-flat btn-default']) ?>

        <?= Html::button(Html::tag('i', '', ['class' => 'fa fa fa-level-up']), [
            'class'       => 'index-search-button btn btn-flat btn-default',
            "data-toggle" => "collapse",
            "data-target" => "#post-type-search",
        ]) ?>

    </div>
    <?php ActiveForm::end() ?>

</div>
