<?php
/**
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

use codezeen\yii2\tinymce\TinyMce;
use dosamigos\datetimepicker\DateTimePicker;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="post-form">
    <?= $form->field($model, 'post_title', ['template' => '{input}{error}'])->textInput([
        'placeholder' => $model->getAttributeLabel('post_title'),
    ]) ?>

    <?= $form->field($model, 'post_slug', [
        'template' => '<span class="input-group-addon">' . $model->getAttributeLabel('post_slug') . '</span>{input}',
        'options'  => [
            'class' => 'input-group form-group input-group-sm',
        ],
    ])->textInput(['maxlength' => 255, 'placeholder' => $model->getAttributeLabel('post_slug')]) ?>


        <div class="form-group">
            <?= Html::button('<i class="fa fa-folder-open"></i> ' . Yii::t('yii2-cms', 'Open Media'), [
                'data-url' => Url::to(['/media/popup', 'post_id' => $model->id, 'editor' => true]),
                'class'    => 'open-editor-media btn btn-default btn-flat',
            ]) ?>

        </div>

    <?= $form->field($model, 'post_content', ["template" => "{input}\n{error}"])->widget(
        TinyMce::className(),
        [
            'settings'        => [
                'menubar'            => false,
                'skin_url'           => Url::base(true) . '/editor-skins/editor-theme',
                'toolbar_items_size' => 'medium',
                'toolbar'            => 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter '
                    . 'alignright alignjustify | bullist numlist outdent indent | link image | code fullscreen',
                'formats'            => [
                    'alignleft'   => [
                        'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img',
                        'classes'  => 'align-left',
                    ],
                    'aligncenter' => [
                        'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img',
                        'classes'  => 'align-center',
                    ],
                    'alignright'  => [
                        'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img',
                        'classes'  => 'align-right',
                    ],
                    'alignfull'   => [
                        'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img',
                        'classes'  => 'align-full',
                    ],
                ],
            ],
            'options'         => [
                'id'    => 'post-post_content',
                'style' => 'height:400px;',
            ],
        ]
    ) ?>

    <?= $form->field($model, 'post_date', ['template'=>'{input}'])->widget(DateTimePicker::className(), [
        'size' => 'sm',
        'template' => '{reset}{button}{input}',
        'pickButtonIcon' => 'glyphicon glyphicon-time',
        'options' => [
            'value'=>$model->isNewRecord? date('M d, Y h:i:s'): Yii::$app->formatter->asDatetime($model->post_date, 'php:M d, Y h:i:s')
        ],
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'M dd, yyyy hh:ii:ss',
            'todayBtn' => true,
        ]
    ]); ?>
    <?= Html::submitButton('Publish', ['class' => 'btn btn-sm btn-flat btn-primary']) ?>

    <?= !$model->isNewRecord ? Html::a('Delete', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-wd-post btn-sm btn-flat btn-danger pull-right',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
        ],
    ]) : '' ?>

</div>
<?php $this->registerJs('$(function () {
    "use strict";
    $(".open-editor-media ").click(function (e) {
        e.preventDefault();
        var w = window,
            d = document,
            e = d.documentElement,
            g = d.getElementsByTagName("body")[0],
            x = w.innerWidth || e.clientWidth || g.clientWidth,
            y = w.innerHeight|| e.clientHeight|| g.clientHeight;

        tinyMCE.activeEditor.windowManager.open({
            file : $(this).data("url"),
            title : "Filemanager",
            width : x * 0.95,
            height : y * 0.9,
            resizable : "yes",
            inline : "yes",
            close_previous : "no"
        });
    });
});') ?>
