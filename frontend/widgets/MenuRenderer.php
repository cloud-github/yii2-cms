<?php
/**
 * @file    MenuRenderer.php.
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

/**
 * Class MenuRenderer to render menu item in admin menu.
 *
 * @package backend\widgets\menubuilder
 */
class MenuRenderer extends Widget
{
    /**
     * @var array
     */
    public $items = [];

    /**
     * @inheritdoc
     */
    public function run()
    {
        echo Html::beginTag('ul', ['class' => 'list-menu dd-list']);

        if ($this->items)
            $this->renderRecursive($this->items);

        echo Html::endTag('ul');
    }

    /**
     * Render menu item recursively.
     *
     * @param $items
     */
    protected function renderRecursive($items)
    {
        /**
         * @var $item \common\models\MenuItem
         */
        foreach ($items as $item) {
            echo Html::beginTag('li', ['class' => 'dd-item', 'data-id' => $item->id]);

            // echo $this->render('render', ['item' => $item]);
            echo $this->renderFile('@app/views/menu/_render-item.php', ['item' => $item]);
            if (isset($item->items) && count($item->items)) {
                echo Html::beginTag('ul', ['class' => 'dd-list children']);
                $this->renderRecursive($item['items']);
                echo Html::endTag('ul');
            }

            echo Html::endTag('li');
        }
    }
}