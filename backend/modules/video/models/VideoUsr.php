<?php

namespace app\modules\video\models;

use Yii;
use app\modules\video\models\Video;
use nill\users\models\User;

/**
 * This is the model class for table "{{%video_usr}}".
 *
 * @property integer $id
 * @property integer $video_id
 * @property integer $user_id
 */
class VideoUsr extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video_usr}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['video_id', 'user_id'], 'required'],
            [['video_id', 'user_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ru', 'ID'),
            'video_id' => Yii::t('ru', 'Video ID'),
            'user_id' => Yii::t('ru', 'User ID'),
        ];
    }
    
    /**
     * Scenarios
     */
    public function scenarios() {
        parent::scenarios();
        
         $scenarios['admin-create'] = [
             'video_id',
             'user_id',
         ];
         $scenarios['admin-update'] = [
             'video_id',
             'user_id',
         ];
         $scenarios['default'] = [
             'video_id',
             'user_id',
         ];
         return $scenarios;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasOne(Video::className(), ['id' => 'video_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
