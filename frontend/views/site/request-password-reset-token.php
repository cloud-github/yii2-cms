<?php
/**
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */
use frontend\widgets\Alert;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\PasswordResetRequestForm */

$this->title = 'Request password reset';
?>
<div class="login-box">
    <div class="login-logo">
        <h1>
            <a href="#">
                <img src="<?= Yii::getAlias('@web/img/logo.png') ?>" alt="Yii2-CMS">
            </a>
        </h1>
    </div>

    <?= Alert::widget() ?>

    <div class="login-box-body">
        <p class="login-box-msg">
            <?= Yii::t('yii2-cms', 'Please fill out your email. A link to reset password will be sent there.') ?>
        </p>

        <?php $form = ActiveForm::begin(['id' => 'request-password-token-form']) ?>

        <?= $form->field($model, 'email', [
            'template' => '<div class="form-group has-feedback">{input}<span class="glyphicon glyphicon-envelope form-control-feedback"></span></div>{error}',
        ])->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

        <div class="form-group">
            <?= Html::submitButton('Send', ['class' => 'btn btn-flat btn-primary form-control']) ?>
            
        </div>
        <?php ActiveForm::end() ?>

    </div>
</div>
