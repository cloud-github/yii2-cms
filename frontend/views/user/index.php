<?php
/**
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii2-cms', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="form-inline grid-nav" role="form">
        <div class="form-group">
            <?= Html::dropDownList('bulk-action', null, [
                'activated'   => Yii::t('yii2-cms', 'Activated'),
                'unactivated' => Yii::t('yii2-cms', 'Unactivated'),
                'removed'     => Yii::t('yii2-cms', 'Removed'),
                'deleted'     => Yii::t('yii2-cms', 'Delete permanently'),
            ], [
                'class'  => 'bulk-action form-control',
                'prompt' => 'Change Status',
            ]) ?>

            <?= Html::button(Yii::t('yii2-cms', 'Apply'), ['class' => 'btn btn-flat btn-warning bulk-button']) ?>

            <?php
            $role = ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name');
            unset($role['superadmin']);

            if (Yii::$app->user->can('administrator') && !Yii::$app->authManager->checkAccess(Yii::$app->user->id,
                    'superadmin')
            ) {
                unset($role['administrator']);
            }

            echo Html::dropDownList('bulk-role', null, $role, [
                'class'  => 'bulk-role form-control',
                'prompt' => 'Change Role',
            ]);
            ?>

            <?= Html::button(Yii::t('yii2-cms', 'Apply'), ['class' => 'btn btn-flat btn-warning role-button']) ?>

            <?= Html::a(Yii::t('yii2-cms', 'Add New User'), ['create'],
                ['class' => 'btn btn-flat btn-primary']) ?>

            <?= Html::button(Html::tag('i', '', ['class' => 'fa fa-search']), [
                'class'       => 'btn btn-flat btn-info',
                "data-toggle" => "collapse",
                "data-target" => "#user-search",
            ]) ?>

        </div>
    </div>
    <?php Pjax::begin() ?>
    <?= $this->render('_search', ['model' => $searchModel]) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'id'           => 'user-grid-view',
        'columns'      => [
            ['class' => 'yii\grid\CheckboxColumn'],

            'username',
            'email:email',
            [
                'attribute' => 'role',
                'value'     => function ($model) {
                    return implode(', ',
                        ArrayHelper::getColumn(Yii::$app->authManager->getRolesByUser($model->id), 'name'));
                },
            ],
            [
                'attribute' => 'status',
                'value'     => function ($model) {
                    return $model->statustext;
                },
                'filter'    => $searchModel->getStatus(),
            ],
            [
                'class'   => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($url, $model) {
                        if (Yii::$app->user->can('superadmin')
                            || (Yii::$app->user->can('administrator')
                                && !Yii::$app->authManager->checkAccess($model->id, 'administrator'))
                        ) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title'     => Yii::t('yii', 'Update'),
                                'data-pjax' => '0',
                            ]);
                        }

                        return false;
                    },
                    'delete' => function ($url, $model) {
                        if (Yii::$app->user->can('superadmin')
                            || (Yii::$app->user->can('administrator')
                                && !Yii::$app->authManager->checkAccess($model->id, 'administrator'))
                        ) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title'        => Yii::t('yii', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method'  => 'post',
                                'data-pjax'    => '0',
                            ]);
                        }

                        return false;
                    },
                ],
            ],
        ],
    ]) ?>

    <?php Pjax::end() ?>

</div>
<?php $this->registerJs('jQuery(".bulk-button").click(function(e){
    e.preventDefault();
    if(confirm("' . Yii::t("yii2-cms", "Are you sure to do this?") . '")){
        var ids     = $("#user-grid-view").yiiGridView("getSelectedRows");
        var action  = $(this).parents(".form-group").find(".bulk-action").val();
        $.ajax({
            url: "' . Url::to(["/user/bulk-action"]) . '",
            data: { ids: ids, action: action, _csrf: yii.getCsrfToken() },
            type:"POST",
            success: function(response){
                $.pjax.reload({container:"#user-grid-view"});
            }
        });
    }
});
jQuery(".role-button").click(function(e){
    e.preventDefault();
    if(confirm("' . Yii::t("yii2-cms", "Are you sure to do this?") . '")){
        var ids     = $("#user-grid-view").yiiGridView("getSelectedRows");
        var role    = $(this).parents(".form-group").find(".bulk-role").val();
        $.ajax({
            url: "' . Url::to(["/user/bulk-action"]) . '",
            data: { ids: ids, action: "changerole", role: role, _csrf: yii.getCsrfToken() },
            type:"POST",
            success: function(response){
                $.pjax.reload({container:"#user-grid-view"});
            }
        });
    }
});') ?>
