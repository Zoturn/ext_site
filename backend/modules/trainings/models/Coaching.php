<?php

namespace app\modules\trainings\models;

use Yii;
use app\modules\video\models\VideoLimits;
use app\modules\video\models\VideoType;
use nill\users\models\backend\User;
use yii\helpers\ArrayHelper;
use vova07\fileapi\behaviors\UploadBehavior;
use app\modules\trainings\traits\ModuleTrait;

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
class Coaching extends \yii\db\ActiveRecord {

    use ModuleTrait;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%coaching}}';
    }

    public function behaviors() {
        return [
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'photo' => [
                        'path' => $this->module->previewPath,
                        'tempPath' => $this->module->imagesTempPath,
                        'url' => $this->module->previewUrl
                    ],
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'description', 'fsp', 'type_id', 'limit_id'], 'required'],
            [['user_id', 'fsp', 'type_id', 'limit_id', 'video_id'], 'integer'],
            [['description', 'link_forum', 'link'], 'string'],
            [['photo'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('ru', 'ID'),
            'user_id' => Yii::t('ru', 'User'),
            'photo' => Yii::t('ru', 'Photo'),
            'description' => Yii::t('ru', 'Description'),
            'fsp' => Yii::t('ru', 'Fsp'),
            'type_id' => Yii::t('ru', 'Type ID'),
            'limit_id' => Yii::t('ru', 'Limit ID'),
            'video_id' => Yii::t('ru', 'Video ID'),
            'link' => Yii::t('ru', 'Link'),
            'link_forum' => Yii::t('ru', 'Link Forum'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['admin-create'] = [
            'user_id',
            'photo',
            'description',
            'fsp',
            'type_id',
            'limit_id',
            'video_id',
            'link',
            'link_forum',
        ];
        $scenarios['admin-update'] = [
            'user_id',
            'photo',
            'description',
            'fsp',
            'type_id',
            'limit_id',
            'video_id',
            'link',
            'link_forum',
        ];

        return $scenarios;
    }

    /**
     * Получить список всех пользователей для вывода в форме
     * @return array
     */
    public function getAllUsers() {
        $model = User::find()->asArray()->all();
        $result = ArrayHelper::map($model, 'id', 'username');
        return $result;
    }

    /**
     * Получить текущее лимиты
     * @param type $type_id
     * @return type
     */
    public function getCurrentLimits($type_id) {
        $model = VideoLimits::find()->where(['type_id' => $type_id])->asArray()->all();
        $limits = ArrayHelper::map($model, 'id', 'name');
        return $limits;
    }

    /**
     * Получить список типов
     * @return array
     */
    public function getTyper() {
        $models = VideoType::find()->asArray()->all();
        $result = ArrayHelper::map($models, 'id', 'name');
        return $result;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
