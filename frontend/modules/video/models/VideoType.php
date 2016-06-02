<?php

namespace app\modules\video\models;

use Yii;

/**
 * This is the model class for table "{{%video_type}}".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Video[] $videos
 * @property VideoLimits[] $videoLimits
 */
class VideoType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'description'], 'required'],
            [['id'], 'integer'],
            [['name', 'description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ru', 'ID'),
            'name' => Yii::t('ru', 'Name'),
            'description' => Yii::t('ru', 'Description'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasMany(Video::className(), ['type_id' => 'id'])->inverseOf('type');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideoLimits()
    {
        return $this->hasMany(VideoLimits::className(), ['type_id' => 'id']);
    }
}
