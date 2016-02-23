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
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('yii2-cms', 'View User: {username}', ['username' => $model->username]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii2-cms', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <?php if (Yii::$app->user->can('superadmin') || (Yii::$app->user->can('administrator') && !Yii::$app->authManager->checkAccess($model->id, 'administrator'))): ?>
        <p>
            <?= Html::a(Yii::t('yii2-cms', 'Update'), ['update', 'id' => $model->id], [
                'class' => 'btn btn-flat btn-primary',
            ]) ?>
            <?= Html::a(Yii::t('yii2-cms', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-flat btn-danger',
                'data'  => [
                    'confirm' => Yii::t('yii2-cms', 'Are you sure you want to delete this item?'),
                    'method'  => 'post',
                ],
            ]) ?>
        </p>
    <?php endif ?>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'username',
            'email:email',
            'full_name',
            'display_name',
            [
                'attribute' => 'status',
                'value'     => $model->getStatusText(),
            ],
            [
                'attribute' => 'role',
                'value'     => implode(', ',
                    ArrayHelper::getColumn(Yii::$app->authManager->getRolesByUser($model->id), 'name')),
            ],
            'created_at:datetime',
            'updated_at:datetime',
            'login_at:datetime',
        ],
    ]) ?>

</div>
