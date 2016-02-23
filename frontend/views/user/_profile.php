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
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="user-form">
    <?php $form = ActiveForm::begin(['id' => 'user-profile-form']) ?>

    <?= $form->field($model, 'username')->textInput([
        'maxlength'   => 255,
        'placeholder' => $model->getAttributeLabel('username'),
    ]) ?>

    <?= $form->field($model, 'email')->textInput([
        'maxlength'   => 255,
        'placeholder' => $model->getAttributeLabel('email'),
    ])->hint(Yii::t('yii2-cms', 'The email is used for notification and reset password')) ?>

    <?= $form->field($model, 'full_name')->textInput([
        'maxlength'   => 255,
        'placeholder' => $model->getAttributeLabel('full_name'),
    ]) ?>

    <?= $form->field($model, 'display_name')->textInput([
        'maxlength'   => 255,
        'placeholder' => $model->getAttributeLabel('display_name'),
    ])->hint(Yii::t('yii2-cms', 'This name will appear on public')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii2-cms', 'Update'), ['btn btn-flat btn-primary']) ?>

    </div>
    <?php ActiveForm::end() ?>

</div>
