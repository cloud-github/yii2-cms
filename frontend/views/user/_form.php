<?php
/**
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="user-form">
    <?php $form = ActiveForm::begin(['id' => 'user-form']) ?>

    <?= $form->field($model, 'username')->textInput([
        'maxlength'   => 255,
        'placeholder' => $model->getAttributeLabel('username'),
    ]) ?>

    <?= $form->field($model, 'email')->input('email', [
        'maxlength'   => 255,
        'placeholder' => $model->getAttributeLabel('email'),
    ])->hint(Yii::t('yii2-cms', 'An e-mail used for receiving notification and resetting password.')) ?>

    <?= $model->isNewRecord ? $form->field($model, 'password')->passwordInput([
        'maxlength'   => 255,
        'placeholder' => $model->getAttributeLabel('password'),
    ]) : '' ?>

    <?= $form->field($model, 'full_name')->textInput([
        'maxlength'   => 255,
        'placeholder' => $model->getAttributeLabel('full_name'),
    ]) ?>

    <?= $form->field($model, 'display_name')->textInput([
        'maxlength'   => 255,
        'placeholder' => $model->getAttributeLabel('display_name'),
    ])->hint(Yii::t('yii2-cms', 'Display name will be used as your public name.')) ?>

    <?= $form->field($model, 'status')->dropDownList($model->getStatus()) ?>

    <?php
    $role = ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name');
    unset($role['superadmin']);

    if (Yii::$app->user->can('administrator')
        && !Yii::$app->authManager->checkAccess(Yii::$app->user->id, 'superadmin')
    ) {
        unset($role['administrator']);
    }

    echo $form->field($model, 'role')->dropDownList($role);
    ?>

    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('yii2-cms', 'Save') : Yii::t('yii2-cms', 'Update'),
            ['class' => $model->isNewRecord ? 'btn-flat btn btn-success' : 'btn-flat btn btn-primary']
        ) ?>
    </div>
    <?php ActiveForm::end() ?>

</div>
