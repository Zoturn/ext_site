<?php

namespace app\modules\video\models;

use Yii;

/**
 * This is the model class for table "{{%video_tags}}".
 *
 * @property integer $id
 * @property string $tags
 */
class VideoTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video_tags}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag'], 'required'],
            [['tag'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ru', 'ID'),
            'tag' => Yii::t('ru', 'Tags'),
        ];
    }
}
