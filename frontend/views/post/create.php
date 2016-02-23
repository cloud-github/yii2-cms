<?php
/**
 * @file      create.php.
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $postType common\models\PostType */

$this->title = Yii::t('yii2-cms', 'Add New {postType}', ['postType' => $postType->post_type_sn]);

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('yii2-cms', 'Posts'),
    'url'   => ['index', 'post_type' => $postType->id],
];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin([
    'id'      => 'post-create-form',
    'options' => ['class' => 'post-create'],
]) ?>

    <div class="row">
        <div class="col-md-12">
            <?= $this->render('_form', [
                'model' => $model,
                'form'  => $form,
            ]) ?>

        </div>
    </div>
<?php ActiveForm::end() ?>