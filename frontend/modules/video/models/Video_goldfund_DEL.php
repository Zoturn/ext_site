<?php

namespace app\modules\video\models;

use Yii;
use app\modules\video\models\Videoparsed;
use app\modules\video\models\VideoLimits;

/**
 * This is the model class for table "{{%video}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $embed
 * @property string $description
 * @property integer $val
 * @property integer $author_id
 * @property integer $section
 * @property string $alias
 * @property string $ids
 * @property integer $date
 * @property integer $duration
 * @property string $conspects
 * @property string $id_training
 * @property string $password
 * @property integer $type_id
 * @property integer $limit_id
 * @property string $tags
 * @property string $preview
 * @property integer $comments
 * @property integer $gp
 * @property string $author
 * @property integer $sortOrder
 *
 * @property VideoType $type
 * @property VideoLimits $limit
 */
class Video_goldfund extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'embed', 'description', 'author_id', 'section', 'alias', 'ids', 'date', 'duration', 'conspects', 'id_training', 'password', 'tags', 'preview', 'comments', 'gp', 'author', 'sortOrder'], 'required'],
            [['description', 'conspects', 'author'], 'string'],
            [['val', 'author_id', 'section', 'date', 'duration', 'type_id', 'limit_id', 'comments', 'gp', 'sortOrder'], 'integer'],
            [['title', 'ids'], 'string', 'max' => 128],
            [['embed', 'alias', 'password', 'preview'], 'string', 'max' => 256],
            [['id_training'], 'string', 'max' => 11],
            [['tags'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ru', 'ID'),
            'title' => Yii::t('ru', 'Title'),
            'embed' => Yii::t('ru', 'Embed'),
            'description' => Yii::t('ru', 'Description'),
            'val' => Yii::t('ru', 'Val'),
            'author_id' => Yii::t('ru', 'Author ID'),
            'section' => Yii::t('ru', 'Section'),
            'alias' => Yii::t('ru', 'Alias'),
            'ids' => Yii::t('ru', 'Ids'),
            'date' => Yii::t('ru', 'Date'),
            'duration' => Yii::t('ru', 'Duration'),
            'conspects' => Yii::t('ru', 'Conspects'),
            'id_training' => Yii::t('ru', 'Id Training'),
            'password' => Yii::t('ru', 'Password'),
            'type_id' => Yii::t('ru', 'Type ID'),
            'limit_id' => Yii::t('ru', 'Limit ID'),
            'tags' => Yii::t('ru', 'Tags'),
            'preview' => Yii::t('ru', 'Preview'),
            'comments' => Yii::t('ru', 'Comments'),
            'gp' => Yii::t('ru', 'Gp'),
            'author' => Yii::t('ru', 'Author'),
            'sortOrder' => Yii::t('ru', 'Sort Order'),
            'videoparsed.id' => Yii::t('ru', 'Parsed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(VideoType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLimit()
    {
        return $this->hasOne(VideoLimits::className(), ['id' => 'limit_id']);
    }

    /**
     * Связь разобранно
     * @return type
     */
    public function getVideoparsed() {
        // VideoUsr has_many Video via Video.video_id -> id
        return $this->hasOne(Videoparsed::className(), ['video_id' => 'id']);
    }
    
    /**
     * Связь видео-пользователь
     * @return type
     */
    public function getVideoUsr() {
        // VideoUsr has_many Video via Video.video_id -> id
        return $this->hasOne(VideoUsr::className(), ['video_id' => 'id']);
    }
}
