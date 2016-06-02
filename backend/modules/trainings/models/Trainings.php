<?php

namespace app\modules\trainings\models;

use Yii;
use app\modules\video\models\VideoType;
use yii\helpers\ArrayHelper;
use app\modules\video\models\VideoLimits;
use app\modules\trainings\traits\ModuleTrait;
use nill\users\models\User;

/**
 * Class Trainings
 * @package app\modules\trainings\models
 * Trainings model.
 *
 * @property integer $id ID
 * @property string $title Title
 * @property string $url
 * @property string $description
 * @property integer $val
 * @property integer $author_id
 * @property string $alias
 * @property integer $date
 * @property string $password
 * @property integer $type_id
 * @property integer $limit_id
 * @property integer $time_start
 * @property integer $time_end
 */
class Trainings extends \yii\db\ActiveRecord {

    use ModuleTrait;

    /** Unpublished status * */
    const STATUS_UNPUBLISHED = 0;

    /** Published status * */
    const STATUS_PUBLISHED = 1;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%trainings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'url', 'description', 'alias', 'date', 'time_start', 'time_end'], 'required'],
            [['description', 'meta'], 'string'],
            [['date'], 'safe'],
            [['val'], 'number'],
            [['alias'], 'unique'],
            //[['time_start', 'time_end'], 'date' , 'format'=>'h:m:s'],
            [['author_id', 'type_id', 'limit_id', 'stat_f'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['url', 'alias', 'password'], 'string', 'max' => 256],
            [
                'status_id',
                'default',
                'value' => $this->module->moderation ? self::STATUS_PUBLISHED : self::STATUS_UNPUBLISHED
            ],
            ['status_id', 'in', 'range' => array_keys(self::getStatusArray())]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('ru', 'ID'),
            'title' => Yii::t('ru', 'Title'),
            'url' => Yii::t('ru', 'URL'),
            'description' => Yii::t('ru', 'Description'),
            'val' => Yii::t('ru', 'Val'),
            'author_id' => Yii::t('ru', 'Author'),
            'alias' => Yii::t('ru', 'Alias'),
            'date' => Yii::t('ru', 'Date'),
            'password' => Yii::t('ru', 'Password'),
            'type_id' => Yii::t('ru', 'Type ID'),
            'limit_id' => Yii::t('ru', 'Limit ID'),
            'time_start' => Yii::t('ru', 'Time Start'),
            'time_end' => Yii::t('ru', 'Time End'),
            'status_id' => Yii::t('ru', 'Status'),
            'stat_f' => Yii::t('ru', 'Freestylepoker own'),
            'meta' => Yii::t('ru', 'Meta Description'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['admin-create'] = [
            'title',
            'url',
            'description',
            'val',
            'author_id',
            'alias',
            'date',
            'password',
            'type_id',
            'limit_id',
            'time_start',
            'time_end',
            'status_id',
            'stat_f',
            'meta',
        ];
        $scenarios['admin-update'] = [
            'title',
            'url',
            'description',
            'val',
            'author_id',
            'alias',
            'date',
            'password',
            'type_id',
            'limit_id',
            'time_start',
            'time_end',
            'status_id',
            'stat_f',
            'meta',
        ];

        return $scenarios;
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if (!Yii::$app->user->can('administrateTrainings')) {
            $this->status_id = self::STATUS_UNPUBLISHED;
        }
        // сохраним владельца
        if ($this->isNewRecord) {
            $this->author_id = Yii::$app->user->id;
        }

        // установить правильный формат даты
        return $this->date = Yii::$app->formatter->asTimestamp($this->date);
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
     * @return string Readable blog status
     */
    public function getStatus() {
        $statuses = self::getStatusArray();

        return $statuses[$this->status_id];
    }

    /**
     * @return array Status array.
     */
    public static function getStatusArray() {
        return [
            self::STATUS_UNPUBLISHED => Yii::t('ru', 'STATUS_UNPUBLISHED'),
            self::STATUS_PUBLISHED => Yii::t('ru', 'STATUS_PUBLISHED')
        ];
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

}
