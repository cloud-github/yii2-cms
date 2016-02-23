<?php
/**
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('yii2-cms', 'Add New User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii2-cms', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
