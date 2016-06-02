<?php

namespace app\modules\trainings\models;

use Yii;
use app\modules\video\models\VideoLimits;
use app\modules\video\models\VideoType;
use nill\users\models\backend\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%coaching}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $photo
 * @property string $description
 * @property integer $fsp
 * @property integer $type_id
 * @property integer $limit_id
 * @property integer $video_id
 * @property string $link
 * @property string $link_forum
 */
class Coaching extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%coaching}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'description', 'fsp', 'type_id', 'limit_id'], 'required'],
            [['user_id', 'fsp', 'type_id', 'limit_id', 'video_id'], 'integer'],
            [['description'], 'string'],
            [['photo', 'link', 'link_forum'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ru', 'ID'),
            'user_id' => Yii::t('ru', 'User ID'),
            'photo' => Yii::t('ru', 'Photo'),
            'description' => Yii::t('ru', 'Description'),
            'fsp' => Yii::t('ru', 'F$P'),
            'type_id' => Yii::t('ru', 'Type ID'),
            'limit_id' => Yii::t('ru', 'Limit ID'),
            'video_id' => Yii::t('ru', 'Video ID'),
            'link' => Yii::t('ru', 'Link'),
            'link_forum' => Yii::t('ru', 'Link Forum'),
        ];
    }
    
    /**
     * Связь автор-пользователь
     * @return type
     */
    public function getUser() {
        // VideoUsr has_many Video via Video.video_id -> id
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLimit() {
        return $this->hasOne(VideoLimits::className(), ['id' => 'limit_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType() {
        return $this->hasOne(VideoType::className(), ['id' => 'type_id']);
    }
}
