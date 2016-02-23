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
/* @var $model \common\models\LoginForm */

$this->title = Yii::t('yii2-cms', 'Sign In');
?>
<div class="login-box">
    <div class="login-logo">
        <h1>
            <a href="#">
                <img src="<?= Yii::getAlias('@web/img/logo.png') ?>" alt="Yii2 CMS">
            </a>
        </h1>
    </div>

    <?= Alert::widget() ?>

    <div class="login-box-body">
        <p class="login-box-msg"><?= Yii::t('yii2-cms', 'Sign in to start your session') ?></p>
        <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>

        <?= $form->field($model, 'username', [
            'template' => '<div class="form-group has-feedback">{input}<span class="glyphicon glyphicon-user form-control-feedback"></span></div>{error}',
        ])->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form->field($model, 'password', [
            'template' => '<div class="form-group has-feedback">{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span></div>{error}',
        ])->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>

            </div>
            <div class="col-xs-4">
                <?= Html::submitButton('Signin', [
                    'class' => 'btn btn-primary btn-block btn-flat',
                    'name'  => 'signin-button',
                ]) ?>

            </div>
        </div>
        <?php ActiveForm::end() ?>

        <?= Html::a(Yii::t('yii2-cms', 'Reset Password'), ['/site/request-password-reset']) ?><br/>
    </div>
    <br/>

</div>
