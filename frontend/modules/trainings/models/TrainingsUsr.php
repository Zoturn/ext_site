<?php

namespace app\modules\trainings\models;

use Yii;

/**
 * This is the model class for table "{{%trainings_usr}}".
 *
 * @property integer $id
 * @property integer $video_id
 * @property integer $user_id
 */
class TrainingsUsr extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%trainings_usr}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['training_id', 'user_id'], 'required'],
            [['training_id', 'user_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ru', 'ID'),
            'training_id' => Yii::t('ru', 'Training ID'),
            'user_id' => Yii::t('ru', 'User ID'),
        ];
    }
}
