<?php

namespace frontend\widgets;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * Class Menu
 * @package vova07\themes\admin\widgets
 * Theme menu widget.
 */
class Menu extends \yii\widgets\Menu
{
    public $linkTemplate = '<a href="{url}" {linkOptions}>{icon}<span>{label}</span>{right-icon}{badge}</a>';
    public $labelTemplate = '<a href="#">{icon}<span>{label}</span>{right-icon}{badge}</a>';
    public $submenuTemplate = "\n<ul class=\"treeview-menu{open}\"{block}>\n{items}\n</ul>\n";
    public $activateParents = true;
    public $options = ['class' => 'sidebar-menu'];

    /**
     * @var string Default tag for badge.
     */
    public $badgeTag = 'small';
    /**
     * @var string Default class for badge.
     */
    public $badgeClass = 'badge pull-right';
    /**
     * @var string Default background color for badge.
     */
    public $badgeBgClass = 'bg-green';
    /**
     * @var string Class for parent icon
     */
    public $parentRightIcon = 'fa fa-angle-left pull-right';

    /**
     * @inheritdoc
     */
    protected function renderItems($items)
    {
        $n = count($items);
        $lines = [];
        foreach ($items as $i => $item) {
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];
            if (!empty($item['items'])) {
                $class[] = 'treeview';
            }
            if ($item['active']) {
                $class[] = $this->activeCssClass;
            }
            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }
            if (!empty($class)) {
                if (empty($options['class'])) {
                    $options['class'] = implode(' ', $class);
                } else {
                    $options['class'] .= ' ' . implode(' ', $class);
                }
            }
            $menu = $this->renderItem($item);
            if (!empty($item['items'])) {
                $submenuTemplate = ArrayHelper::getValue($item, 'submenuTemplate', $this->submenuTemplate);
                $menu .= strtr($submenuTemplate, [
                    '{open}'  => $item['active'] ? ' menu-open' : '',
                    '{block}' => $item['active'] ? 'style="display: block"' : '',
                    '{items}' => $this->renderItems($item['items']),
                ]);
            }
            if ($tag === false) {
                $lines[] = $menu;
            } else {
                $lines[] = Html::tag($tag, $menu, $options);
            }
        }

        return implode("\n", $lines);
    }

    /**
     * @inheritdoc
     */
    protected function renderItem($item)
    {
        $item['badgeOptions'] = isset($item['badgeOptions']) ? $item['badgeOptions'] : [];

        if (!ArrayHelper::getValue($item, 'badgeOptions.class')) {
            $badgeBgClass = isset($item['badgeBgClass']) ? $item['badgeBgClass'] : $this->badgeBgClass;
            $item['badgeOptions']['class'] = $this->badgeClass . ' ' . $badgeBgClass;
        }

        if (isset($item['items']) && !isset($item['right-icon'])) {
            $item['right-icon'] = $this->parentRightIcon;
        }

        if (isset($item['url'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);

            return strtr($template, [
                '{icon}'        => isset($item['icon']) ? '<i class="' . $item['icon'] . '"></i> ' : null,
                '{url}'         => Html::encode(Url::to($item['url'])),
                '{label}'       => $item['label'],
                '{right-icon}'  => isset($item['right-icon'])
                    ? '<i class="' . $item['right-icon'] . '"></i>'
                    : null,
                '{badge}'       => isset($item['badge'])
                    ? Html::tag($this->badgeTag, $item['badge'], $item['badgeOptions'])
                    : null,
                '{linkOptions}' => isset($item['linkOptions']) ? Html::renderTagAttributes($item['linkOptions']) : null,
            ]);
        }

        $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

        return strtr($template, [
            '{icon}'        => isset($item['icon']) ? '<i class="' . $item['icon'] . '"></i> ' : null,
            '{label}'       => $item['label'],
            '{right-icon}'  => isset($item['right-icon']) ? '<i class="' . $item['right-icon'] . '"></i>' : null,
            '{badge}'       => isset($item['badge']) ? Html::tag($this->badgeTag, $item['badge'],
                $item['badgeOptions']) : null,
            '{linkOptions}' => isset($item['linkOptions']) ? Html::renderTagAttributes($item['linkOptions']) : null,
        ]);
    }

    /**
     * @inheritdoc
     */
    protected function isItemActive($item)
    {
        if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
            $route = Yii::getAlias($item['url'][0]);
            if ($route[0] !== '/' && Yii::$app->controller) {
                $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
            }
            if (trim($route, '/') !== $this->route) {
                return false;
            }
            unset($item['url']['#']);
            if (count($item['url']) > 1) {
                $params = $item['url'];
                unset($params[0]);
                foreach ($params as $name => $value) {
                    if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
                        return false;
                    }
                }
            }

            return true;
        }

        return false;
    }
}
