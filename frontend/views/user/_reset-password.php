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
    <?php $form = ActiveForm::begin(['id' => 'user-reset-password-form']) ?>

    <?= $form->field($model, 'password_old')->passwordInput([
        'maxlength'   => 255,
        'placeholder' => $model->getAttributeLabel('password_old'),
    ]) ?>

    <?= $form->field($model, 'password')->passwordInput([
        'maxlength'   => 255,
        'placeholder' => $model->getAttributeLabel('password'),
    ]) ?>

    <?= $form->field($model, 'password_repeat')->passwordInput([
        'maxlength'   => 255,
        'placeholder' => $model->getAttributeLabel('password_repeat'),
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('yii2-cms', 'Save my new password'), ['class' => 'btn-flat btn btn-primary']) ?>

    </div>
    <?php ActiveForm::end() ?>

</div>
