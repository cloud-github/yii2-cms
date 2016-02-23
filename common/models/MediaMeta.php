<?php
/**
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
 * This is the model class for table "{{%media_meta}}".
 *
 * @property integer $id
 * @property integer $media_id
 * @property string  $meta_name
 * @property string  $meta_value
 *
 * @property Media   $media
 *
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @since   0.1.0
 */
class MediaMeta extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%media_meta}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['media_id', 'meta_name', 'meta_value'], 'required'],
            [['media_id'], 'integer'],
            [['meta_value'], 'string'],
            [['meta_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => Yii::t('yii2-cms', 'ID'),
            'media_id'   => Yii::t('yii2-cms', 'Media ID'),
            'meta_name'  => Yii::t('yii2-cms', 'Meta Name'),
            'meta_value' => Yii::t('yii2-cms', 'Meta Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedia()
    {
        return $this->hasOne(Media::className(), ['id' => 'media_id']);
    }
}
