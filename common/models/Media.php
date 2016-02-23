<?php
/**
 * @file      Media.php.
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

namespace common\models;

use common\components\Json;
use common\models\User;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
/**
 * This is the model class for table "{{%media}}".
 *
 * @property integer        $id
 * @property integer        $media_author
 * @property integer        $media_post_id
 * @property string         $media_title
 * @property string         $media_excerpt
 * @property string         $media_content
 * @property string         $media_date
 * @property string         $media_modified
 * @property string         $media_slug
 * @property string         $media_mime_type
 * @property string         $url
 * @property UploadedFile   $file
 * @property string         $uploadUrl
 *
 * @property Post           $mediaPost
 * @property User           $mediaAuthor
 *
 * @package common\models
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @since   1.0
 */
class Media extends ActiveRecord
{
    public $username;
    public $post_title;
    public $file;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%media}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class'      => SluggableBehavior::className(),
                'attribute'  => 'media_title',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['media_slug'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['upload'] = ['file'];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['media_title', 'media_mime_type'], 'required'],
            [['media_author', 'media_post_id'], 'integer'],
            [['media_title', 'media_excerpt', 'media_content'], 'string'],
            [['media_slug'], 'string', 'max' => 255],
            [['media_mime_type'], 'string', 'max' => 100],
            [['media_date', 'media_modified', 'media_slug'], 'safe'],
            [['file'], 'file', 'maxSize' => 1024 * 1024 * 25],
            [['file'], 'required', 'on' => 'upload'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                   => Yii::t('yii2-cms', 'ID'),
            'media_author'         => Yii::t('yii2-cms', 'Author'),
            'media_post_id'        => Yii::t('yii2-cms', 'Attached to'),
            'media_title'          => Yii::t('yii2-cms', 'Title'),
            'media_excerpt'        => Yii::t('yii2-cms', 'Caption'),
            'media_content'        => Yii::t('yii2-cms', 'Description'),
            'media_date'           => Yii::t('yii2-cms', 'Uploaded'),
            'media_modified'       => Yii::t('yii2-cms', 'Updated'),
            'media_slug'           => Yii::t('yii2-cms', 'Slug'),
            'media_mime_type'      => Yii::t('yii2-cms', 'Mime Type'),
            'username'             => Yii::t('yii2-cms', 'Author'),
            'post_title'           => Yii::t('yii2-cms', 'Post Title'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMediaPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'media_post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMediaAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'media_author']);
    }

    /**
     * Get permalink of current media
     *
     * @return string
     */
    public function getUrl()
    {
        return Yii::$app->urlManagerFront->createAbsoluteUrl(['/media/view', 'id' => $this->id]);
    }

    /**
     * Get meta for current media.
     *
     * @param string $metaName
     *
     * @return mixed|null|string
     */
    public function getMeta($metaName)
    {
        /* @var $model \common\models\MediaMeta */
        $model = MediaMeta::findOne(['meta_name' => $metaName, 'media_id' => $this->id]);

        if ($model) {
            if (Json::isJson($model->meta_value)) {
                return Json::decode($model->meta_value);
            }

            return $model->meta_value;
        }

        return null;
    }

    /**
     * Add new meta data for current media.
     *
     * @param string       $metaName
     * @param string|array $metaValue
     *
     * @return bool
     */
    public function setMeta($metaName, $metaValue)
    {
        if (is_array($metaValue) || is_object($metaValue)) {
            $metaValue = Json::encode($metaValue);
        }

        if ($this->getMeta($metaName) !== null) {
            return $this->upMeta($metaName, $metaValue);
        }

        $model = new MediaMeta();
        $model->media_id = $this->id;
        $model->meta_name = $metaName;
        $model->meta_value = $metaValue;

        return $model->save();
    }

    /**
     * Update meta data for current media.
     *
     * @param string       $metaName
     * @param string|array $metaValue
     *
     * @return bool
     */
    public function upMeta($metaName, $metaValue)
    {
        /* @var $model \common\models\MediaMeta */
        $model = MediaMeta::findOne(['meta_name' => $metaName, 'media_id' => $this->id]);

        if (is_array($metaValue) || is_object($metaValue)) {
            $metaValue = Json::encode($metaValue);
        }

        $model->meta_value = $metaValue;

        return $model->save();
    }

    /**
     * Get upload URL
     *
     * @return string
     */
    public static function getUploadUrl()
    {
        return Yii::$app->urlManagerFront->hostInfo . Yii::$app->urlManagerFront->baseUrl . '/frontend/uploads/';
    }


    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->media_author = Yii::$app->user->id;
                $this->media_date = date('Y-m-d H:i:s');
            }
            $this->media_modified = date('Y-m-d H:i:s');

            return true;
        }

        return false;
    }
}