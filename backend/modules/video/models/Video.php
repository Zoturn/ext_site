<?php

namespace app\modules\video\models;

use Yii;
use yii\helpers\ArrayHelper;
use vova07\fileapi\behaviors\UploadBehavior;
use app\modules\video\traits\ModuleTrait;
use yii\behaviors\SluggableBehavior;
use himiklab\sortablegrid\SortableGridBehavior;
use nill\users\models\User;

/**
 * This is the model class for table "{{%video}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $embed
 * @property string $description
 * @property integer $val
 * @property integer $author_id
 * @property string $author
 * @property integer $section
 * @property string $alias
 * @property string $ids
 * @property string $date
 * @property integer $duration
 * @property string $conspects
 * @property integer $id_training
 * @property string $password
 * @property integer $type_id
 * @property integer $limit_id
 * @property string $tags
 * @property string $preview
 * @property integer $comments
 * @property integer $gp
 * @property VideoType $type
 * @property VideoLimits $limit
 * @property sortOrder $sortOrder
 */
class Video extends \yii\db\ActiveRecord {

    use ModuleTrait;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%video}}';
    }

    public function behaviors() {
        return [
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'preview' => [
                        'path' => $this->module->previewPath,
                        'tempPath' => $this->module->imagesTempPath,
                        'url' => $this->module->previewUrl
                    ],
                    'conspects' => [
                        'path' => $this->module->filePath,
                        'tempPath' => $this->module->imagesTempPath,
                        'url' => $this->module->fileUrl
                    ],
                ]
            ],
            'sluggableBehavior' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'alias'
            ],
            'sort' => [
                'class' => SortableGridBehavior::className(),
                'sortableAttribute' => 'sortOrder'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'embed', 'section', 'date', 'type_id', 'duration', 'preview', 'comments', 'gp', 'author_id'], 'required'],
            [['description', 'conspects', 'tags', 'meta', 'page_title'], 'string'],
            [['sortOrder', 'author_id', 'section', 'duration', 'id_training', 'type_id', 'limit_id', 'comments', 'gp', 'stat_f'], 'integer'],
            [['date'], 'safe'],
            [['val'], 'number'],
            ['val', 'default', 'value' => 0],
            [['title', 'ids'], 'string', 'max' => 128],
            [['embed', 'alias', 'password', 'preview'], 'string', 'max' => 256]
        ];
    }
    
    /**
     * 
     * @inheritdoc
     */
    public function attributeHints() {
        parent::attributeHints();
        
        return [
            'page_title' => Yii::t('ru', 'ATTR_PAGE_TITLE_HINT'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('ru', 'ID'),
            'title' => Yii::t('ru', 'Title'),
            'embed' => Yii::t('ru', 'Embed'),
            'description' => Yii::t('ru', 'Description'),
            'val' => Yii::t('ru', 'Val'),
            'author_id' => Yii::t('ru', 'Author'),
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
            'sortOrder' => Yii::t('ru', 'sortOrder'),
            'stat_f' => Yii::t('ru', 'Freestylepoker own'),
            'meta' => Yii::t('ru', 'Meta Description'),
            'page_title' => Yii::t('ru', 'ATTR_PAGE_TITLE'),
        ];
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);
        
        //$this->description = preg_replace("/[\n]/","<br/>",$this->description);
        
        // Если урок-дня то снять из Золотого фонда
        if($this->section) {
            $this->gp = NULL;
        }
        
        // установить правильный формат даты
        return $this->date = Yii::$app->formatter->asTimestamp($this->date);
        // сохраним владельца
        //return $this->author_id = Yii::$app->user->id;
    }

    // СВЯЗИ

    /**
     * Связь с таблицей типов
     * @return \yii\db\ActiveQuery
     */
    public function getType() {
        return $this->hasOne(VideoType::className(), ['id' => 'type_id'])->inverseOf('videos');
    }

    /**
     * Связь с таблицей лимитов
     * @return \yii\db\ActiveQuery
     */
    public function getLimit() {
        return $this->hasOne(VideoLimits::className(), ['id' => 'limit_id'])->inverseOf('videos');
    }

    // Сценарии

    /**
     * 
     * @return string
     */
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['admin-create'] = [
            'title',
            'embed',
            'val',
            'description',
            'user_id',
            'author_id',
            'section',
            'alias',
            'ids',
            'date',
            'duration',
            'conspects',
            'id_training',
            'password',
            'type_id',
            'limit_id',
            'tags',
            'preview',
            'comments',
            'gp',
            'sortOrder',
            'stat_f',
            'meta',
            'page_title',
        ];
        $scenarios['admin-update'] = [
            'title',
            'embed',
            'val',
            'description',
            'user_id',
            'author_id',
            'section',
            'alias',
            'ids',
            'date',
            'duration',
            'conspects',
            'id_training',
            'password',
            'type_id',
            'limit_id',
            'tags',
            'preview',
            'comments',
            'gp',
            'sortOrder',
            'stat_f',
            'meta',
            'page_title',
        ];

        return $scenarios;
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
     * Пуличить лимиты соответствующие типу
     * @return array
     */
    public static function getPartLimits($type_id) {
        $model = VideoLimits::find()->where(['type_id' => $type_id])->asArray()->all();
        foreach ($model as $key => $value) {
            $limits[] = ['id' => $value['id'], 'name' => $value['name']];
        }
        return $limits;
    }

    /**
     * Получить тэги из таблицы тэгов
     * @return type
     */
    public function getTags() {
        $model = VideoTags::find()->asArray()->all();
        $tags = ArrayHelper::getColumn($model, 'tag');
        return $tags;
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);

        // Добавить новый тег в таблицу тегов 
            $tags = explode(",", $this->tags);
            $model_tags = new VideoTags();
            foreach ($tags as $value) {
                $isset_tag = $model_tags->findOne(['tag' => $value]);
                if ($isset_tag === NULL) {
                    $model_tags->tag = $value;
                    $model_tags->save();
                }
            }
        
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
