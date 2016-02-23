<?php
/**
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

use dosamigos\selectize\SelectizeDropDownList;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PostType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-type-form">
    <?php $form = ActiveForm::begin(['id' => 'post-type-form']) ?>

    <?= $form->field($model, 'post_type_name')->textInput(['maxlength'   => 64,'placeholder' => $model->getAttributeLabel('post_type_name'),])->hint(Yii::t('yii2-cms', 'Used for calling of the post_type. Example: post, page, news.')) ?>

    <?= $form->field($model, 'post_type_slug')->textInput(['maxlength'   => 64,'placeholder' => $model->getAttributeLabel('post_type_slug'),])->hint(Yii::t('yii2-cms', 'Used on the url of the taxonomy ( Use - instead of space for better SEO )')) ?>

    <?= $form->field($model, 'post_type_sn')->textInput(['maxlength'   => 255,'placeholder' => $model->getAttributeLabel('post_type_sn'),]) ?>

    <?= $form->field($model, 'post_type_pn')->textInput(['maxlength'   => 255,'placeholder' => $model->getAttributeLabel('post_type_pn'),]) ?>

    <?= $form->field($model, 'post_type_description')->textarea(['rows' => 6, ]) ?>

    <?= $form->field($model, 'post_type_icon')->widget(SelectizeDropDownList::className(), ['items' => Fa::getConstants(),])->hint(Yii::t('yii2-cms', 'The icon use {FontAwesome} and appears on admin side menu', [
        'FontAwesome' => Html::a('FontAwesome', 'http://www.fontawesome.com/', ['target' => 'blank']),
    ])) ?>

    <?= $form->field($model, 'post_type_smb')->checkbox(['uncheck' => 0, ]) ?>


    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('yii2-cms', 'Save') : Yii::t('yii2-cms', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-flat btn-success' : 'btn btn-flat btn-primary']
        ) ?>

    </div>
    <?php ActiveForm::end() ?>

</div>
