<?php
/**
 * @file      _create.php.
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model common\models\Menu */

$form = ActiveForm::begin([
    'action' => Url::to(['/menu/create'])
]);
?>
    <div class="input-group">
        <?= $form->field($model, 'menu_title', ['template' => '{input}'])->textInput(['placeholder' => $model->getAttributeLabel('menu_title')]) ?>
        <div class="input-group-btn">
            <?= Html::submitButton('Add New Menu', ['class' => 'btn btn-flat btn-primary']); ?>
        </div>
    </div>
<?php ActiveForm::end();