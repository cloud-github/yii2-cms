<?php
/**
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PostType */

$this->title = Yii::t('yii2-cms', 'View Post Type: {post_type_name}', ['post_type_name' => $model->post_type_sn]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii2-cms', 'Post Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-type-view">
    <p>
        <?= Html::a(Yii::t('yii2-cms', 'Update'),
            ['update', 'id' => $model->id],
            ['class' => 'btn btn-flat btn-primary']
        ) ?>

        <?= Html::a(Yii::t('yii2-cms', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-flat btn-danger','data'  => ['confirm' => Yii::t('yii2-cms', 'Are you sure you want to delete this item?'),
                'method'  => 'post',],
        ]) ?>

    </p>
    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            'post_type_name',
            'post_type_slug',
            'post_type_description:ntext',
            [
                'attribute' => 'post_type_icon',
                'value'     => Html::tag('i', '', ['class' => $model->post_type_icon]),
                'format'    => 'raw',
            ],
            'post_type_sn',
            'post_type_pn',
            'post_type_smb:boolean',
        ],
    ]) ?>

</div>
