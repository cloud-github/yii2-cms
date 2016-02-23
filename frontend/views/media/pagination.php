<?php
/**
 * @file      pagination.php.
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */
use yii\widgets\LinkPager;

/* @var $pages \yii\data\Pagination */

echo LinkPager::widget([
    'pagination'     => $pages,
    'maxButtonCount' => 7,
    'linkOptions'    => [
        'class'         => 'pagination-item',
        'data-post_id'  => Yii::$app->request->get('post_id'),
        'data-per-page' => $pages->getPageSize()
    ]
]);
