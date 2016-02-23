<?php
/**
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PostType */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii2-cms', 'Post Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-type-index">
    <div class="form-inline grid-nav" role="form">
        <div class="form-group">
            <?= Html::dropDownList('bulk-action', null, ['delete' => 'Delete'], [
                'class'  => 'bulk-action form-control',
                'prompt' => 'Bulk Action',
            ]) ?>

            <?= Html::button(Yii::t('yii2-cms', 'Apply'), ['class' => 'btn btn-flat btn-warning bulk-button']) ?>

            <?= Html::a(Yii::t('yii2-cms', 'Add New Post Type'),['create'],['class' => 'btn btn-flat btn-primary']) ?>

            <?= Html::button(Html::tag('i', '', ['class' => 'fa fa-search']), [
                'class'       => 'btn btn-flat btn-info',
                "data-toggle" => "collapse",
                "data-target" => "#post-type-search",
            ]) ?>

        </div>
    </div>
    <?php Pjax::begin() ?>
    <?= $this->render('_search', ['model' => $searchModel]) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'id'           => 'post-type-grid-view',
        'columns'      => [
            ['class' => 'yii\grid\CheckboxColumn'],
            'post_type_name',
            'post_type_slug',
            'post_type_description:ntext',
            [
                'attribute' => 'post_type_icon',
                'format'    => 'raw',
                'value'     => function ($model) {
                    return Html::tag('i', '', ['class' => $model->post_type_icon]);
                },
                'filter'    => false,
            ],
            'post_type_sn',
            'post_type_pn',
            [
                'attribute' => 'post_type_smb',
                'format'    => 'boolean',
                'filter'    => $searchModel->getSmb(),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]) ?>

    <?php Pjax::end() ?>

</div>
<?php $this->registerJs('jQuery(".bulk-button").click(function(e){
    e.preventDefault();
    if(confirm("' . Yii::t("yii2-cms", "All posts on these post types will be affected. Are you sure?") . '")){
    var ids     = $("#post-type-grid-view").yiiGridView("getSelectedRows");
    var action  = $(this).parents(".form-group").find(".bulk-action").val();
    $.ajax({
        url: "' . Url::to(["/post-type/bulk-action"]) . '",
        data: { ids: ids, action: action, _csrf: yii.getCsrfToken() },
        type:"POST",
        success: function(data){
            $.pjax.reload({container:"#post-type-grid-view"});
        }
    });
    }
});') ?>
