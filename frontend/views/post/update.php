<?php
/**
 * @file    update.php.
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $postType common\models\PostType */

$this->title = Yii::t('yii2-cms', 'Update {post_type} ',['post_type' => $model->postType->post_type_sn]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii2-cms', 'Posts'), 'url' => ['index', 'post_type' => $postType->id]];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => $model->url];
$this->params['breadcrumbs'][] = Yii::t('yii2-cms', 'Update');
?>

<?php $form = ActiveForm::begin([
    'options' => [
        'class' => 'post-update'
    ]
]); ?>

    <div class="row">
        <div class="col-md-10">

            <?= $this->render('_form', [
                'model' => $model,
                'form'  => $form,
            ]) ?>

        </div>
    </div>

<?php ActiveForm::end();