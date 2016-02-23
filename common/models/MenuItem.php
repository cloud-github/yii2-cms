<?php
/**
 * @file      MenuItem.php.
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%menu_item}}".
 *
 * @property integer $id
 * @property integer $menu_id
 * @property string  $menu_label
 * @property string  $menu_url
 * @property string  $menu_description
 * @property integer $menu_order
 * @property integer $menu_parent
 * @property string  $menu_options
 *
 * @property Menu    $menu
 *
 * @package common\models
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @since   1.0
 */
class MenuItem extends ActiveRecord
{
    public $items;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_id', 'menu_label', 'menu_url'], 'required'],
            [['menu_id', 'menu_order', 'menu_parent'], 'integer'],
            [['menu_url', 'menu_description', 'menu_options'], 'string'],
            [['menu_label'], 'string', 'max' => 255],
            [['menu_url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'               => 'ID',
            'menu_id'          => 'Menu ID',
            'menu_label'       => 'Label',
            'menu_url'         => 'URL',
            'menu_description' => 'Description',
            'menu_order'       => 'Order',
            'menu_parent'      => 'Parent',
            'menu_options'     => 'Options',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menu::className(), ['id' => 'menu_id']);
    }
}
