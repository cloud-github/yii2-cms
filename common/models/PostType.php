<?php
/**
 * @file      PostType.php.
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "{{%post_type}}".
 *
 * @property integer            $id
 * @property string             $post_type_name
 * @property string             $post_type_slug
 * @property string             $post_type_description
 * @property string             $post_type_icon
 * @property string             $post_type_sn
 * @property string             $post_type_pn
 * @property integer            $post_type_smb
 *
 * @property Post[]             $posts
 * @package common\models
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @since   1.0
 */
class PostType extends ActiveRecord
{
    const SMB = 1;
    const NON_SMB = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post_type}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class'      => SluggableBehavior::className(),
                'attribute'  => 'post_type_name',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['post_type_slug'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_type_name', 'post_type_slug', 'post_type_sn', 'post_type_pn'], 'required'],
            [['post_type_description'], 'string'],
            [['post_type_smb'], 'integer'],
            ['post_type_smb', 'in', 'range' => [self::SMB, self::NON_SMB]],
            ['post_type_smb', 'default', 'value' => self::NON_SMB],
            [['post_type_name', 'post_type_slug'], 'string', 'max' => 64],
            [['post_type_icon', 'post_type_sn', 'post_type_pn'], 'string', 'max' => 255],
            [['post_type_name', 'post_type_slug'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                    => Yii::t('yii2-cms', 'ID'),
            'post_type_name'        => Yii::t('yii2-cms', 'Name'),
            'post_type_slug'        => Yii::t('yii2-cms', 'Slug'),
            'post_type_description' => Yii::t('yii2-cms', 'Description'),
            'post_type_icon'        => Yii::t('yii2-cms', 'Icon'),
            'post_type_sn'          => Yii::t('yii2-cms', 'Singular Name'),
            'post_type_pn'          => Yii::t('yii2-cms', 'Plural Name'),
            'post_type_smb'         => Yii::t('yii2-cms', 'Show Menu Builder'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['post_type' => 'id']);
    }

    /**
     * Get array of smb hierarchical for label or dropdown.
     * SMB is abbreviation from Show Menu Builder.
     *
     * @return array
     */


    public function getSmb()
    {
        return [
            self::SMB     => "Yes",
            self::NON_SMB => "No"
        ];
    }

    /**
     * Get all post type which post_type_smb is true.
     * The return value will be used in admin sidebar menu.
     *
     * @param int $position Position of post type in admin site menu
     *
     * @return array
     */
    public static function getMenu($position = 2)
    {
        /* @var $model \common\models\PostType */
        $models = static::find()->all();
        $adminSiteMenu = [];
        foreach ($models as $model) {
            $adminSiteMenu[$position] = [
                'label'   => $model->post_type_pn,
                'icon'    => $model->post_type_icon,
                'items'   => static::getTaxonomyMenu($model),
            ];
            $position++;
        }

        return $adminSiteMenu;
    }

    /**
     * Get all taxonomies in postType to show as submenu.
     *
     * @param \common\models\PostType $postType
     *
     * @return array
     */
    protected static function getTaxonomyMenu($postType)
    {
        $adminSiteSubmenu = [];
        $adminSiteSubmenu[] = [
            'icon'  => 'fa fa-circle-o',
            'label' => Yii::t('app', 'All {post_type_name}', ['post_type_name' => $postType->post_type_pn]),
            'url'   => ['/post/index/', 'post_type' => $postType->id],
        ];
        $adminSiteSubmenu[] = [
            'icon'  => 'fa fa-circle-o',
            'label' => Yii::t('app', 'Add New {post_type_name}', ['post_type_name' => $postType->post_type_sn]),
            'url'   => ['/post/create/', 'post_type' => $postType->id],
        ];
        return $adminSiteSubmenu;
    }

}