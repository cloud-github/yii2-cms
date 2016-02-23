<?php
/**
 * @file    index.php.
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\Post */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $postType common\models\PostType */
/* @var $user integer */

$this->title = $postType->post_type_pn;
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="post-index">

        <div class="form-inline grid-nav" role="form">

            <div class="form-group">

                <?= Html::a(
                    Yii::t('yii2-cms', 'Add New {postType}', ['postType' => $postType->post_type_sn]),
                    ['create', 'post_type' => $postType->id, ],
                    ['class' => 'btn btn-flat btn-primary']
                ) ?>

                <?= Html::dropDownList('bulk-action', null, ['delete' => 'Delete'],
                    ['class' => 'bulk-action form-control']
                ) ?>

                <?= Html::button(Yii::t('yii2-cms', 'Apply'), ['class' => 'btn btn-flat btn-warning bulk-button']) ?>

            </div>
        </div>

        <?php Pjax::begin(); ?>

        <?= $this->render('_search', [
            'model'    => $searchModel,
            'postType' => $postType,
            'user'     => $user
        ]);  ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'id'           => 'post-grid-view',
            'columns'      => [
                [
                    'class'           => 'yii\grid\CheckboxColumn',
                    'checkboxOptions' => function ($model) {
                        return ['value' => $model->id];
                    },
                ],
                [
                    'attribute' => 'username',
                    'value'     => function ($model) {
                        /* @var $model common\models\Post */
                        return $model->postAuthor->username;
                    },
                ],
                'post_title:ntext',
                'post_date',
                ['attribute' => 'post_status', 'filter' => $searchModel->getPostStatus()],

                [
                    'class'   => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view'   => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $model->url, [
                                'title'     => Yii::t('yii', 'View'),
                                'data-pjax' => '0',
                            ]);
                        },
                        'update' => function ($url, $model) {

                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title'     => Yii::t('yii', 'Update'),
                                'data-pjax' => '0',
                            ]);
                        },
                        'delete' => function ($url, $model) {

                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title'        => Yii::t('yii', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method'  => 'post',
                                'data-pjax'    => '0',
                            ]);
                        },
                    ],
                ],
            ],
        ]) ?>

        <?php Pjax::end(); ?>

    </div>

<?php
$this->registerJs('
jQuery(".bulk-button").click(function(e){
    e.preventDefault();
    if(confirm("' . Yii::t("app", "Are you sure to do this?") . '")){
        var ids     = $("#post-grid-view").yiiGridView("getSelectedRows"); // returns an array of pkeys, and #grid is your grid element id
        var action  = $(this).parents(".form-group").find(".bulk-action").val();
        $.ajax({
            url: "' . Url::to(["bulk-action"]) . '",
            data: { ids: ids, action: action, _csrf: yii.getCsrfToken() },
            type:"POST",
            success: function(data){
                $.pjax.reload({container:"#post-grid-view"});
            }
        });
    }
});'
);