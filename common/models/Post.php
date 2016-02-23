<?php
/**
 * @file      Post.php.
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

namespace common\models;

use common\models\User;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property integer            $id
 * @property integer            $post_author
 * @property integer            $post_type
 * @property string             $post_title
 * @property string             $post_excerpt
 * @property string             $post_content
 * @property string             $post_date
 * @property string             $post_modified
 * @property string             $post_status
 * @property string             $post_slug
 * @property string             $url
 * @property []                 $poststatus
 * @property Media[]            $media
 * @property PostType           $postType
 * @property User               $postAuthor
 * @package  common\models
 * @author   Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @since    1.0
 */
class Post extends ActiveRecord
{
    public $username;
    const POST_STATUS_PUBLISH = 'publish';
    const POST_STATUS_UNPUBLISH = 'unpublish';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class'      => SluggableBehavior::className(),
                'attribute'  => 'post_title',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['post_slug'],
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
            [['post_title', 'post_slug'], 'required'],
            [['post_author', 'post_type'], 'integer'],
            [['post_title', 'post_excerpt', 'post_content'], 'string'],
            [['post_date', 'post_modified', 'post_author'], 'safe'],
            [['post_status'], 'string', 'max' => 20],
            [['post_slug'], 'string', 'max' => 255],
            ['post_status', 'in', 'range' => [self::POST_STATUS_PUBLISH, self::POST_STATUS_UNPUBLISH]],
            ['post_status', 'default', 'value' => self::POST_STATUS_PUBLISH],
            [['post_title', 'post_slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                  => 'ID',
            'post_author'         => 'Author',
            'post_type'           => 'Type',
            'post_title'          => 'Title',
            'post_excerpt'        => 'Excerpt',
            'post_content'        => 'Content',
            'post_date'           => 'Date',
            'post_modified'       => 'Modified',
            'post_status'         => 'Status',
            'post_slug'           => 'Slug',
            'username'            => 'Author',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedia()
    {
        return $this->hasMany(Media::className(), ['media_post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostType()
    {
        return $this->hasOne(PostType::className(), ['id' => 'post_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'post_author']);
    }

    /**
     * Get post status as array.
     *
     * @return array
     */
    public function getPostStatus()
    {
        return [
            self::POST_STATUS_PUBLISH => "Publish",
            self::POST_STATUS_UNPUBLISH   => "UnPublish",
        ];
    }

    /**
     * Get permalink of current post
     *
     * @return string
     */
    public function getUrl()
    {
        return Yii::$app->urlManagerFront->createAbsoluteUrl(['/post/view', 'id' => $this->id]);

    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->post_author = Yii::$app->user->id;
            }
            $this->post_modified = new Expression('NOW()');
            $this->post_excerpt = substr(strip_tags($this->post_content), 0, 400);

            return true;
        } else {
            return false;
        }
    }
}