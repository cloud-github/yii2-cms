<?php
/**
 * @file      create.php.
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use frontend\assets\MediaAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Media */

$this->title = Yii::t('yii2-cms', 'Add New Media');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii2-cms', 'Media'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
MediaAsset::register($this);
?>

    <div class="media-create">
        <?php $form = ActiveForm::begin([
            'options' => [
                'enctype'  => 'multipart/form-data',
                'id'       => 'media-upload',
                'data-url' => Url::to(['/media/ajax-upload'])
            ],
            'action'  => Url::to(['/site/forbidden']),
        ]); ?>
        <noscript>
            <?= Html::hiddenInput('redirect', Url::to(['/site/forbidden'])); ?>
        </noscript>

        <div class="dropzone fade">
            <div class="dropzone-inner">
                <?= Yii::t('yii2-cms', 'Drop files here') ?><br/>
                <?= Yii::t('yii2-cms', 'OR') ?><br/>
                <div class="btn btn-default btn-flat fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span><?= Yii::t('yii2-cms', 'Add files...') ?></span>
                    <?= $form->field($model, 'file', [
                        'template' => '{input}',
                        'options'  => ['class' => ''],
                    ])->fileInput(['multiple' => 'multiple']) ?>

                </div>
            </div>
        </div>

        <div role="presentation" class="file-container"></div>

        <?php ActiveForm::end(); ?>

    </div>

<?= $this->render('_template-create'); ?>