<?php
/**
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('yii2-cms', 'Reset Password');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii2-cms', 'Profile'), 'url' => ['profile']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
    <p><?= Yii::t('yii2-cms', 'Please fill out the following fields to reset password:') ?></p>
    <?= $this->render('_reset-password', [
        'model' => $model,
    ]) ?>
</div>
