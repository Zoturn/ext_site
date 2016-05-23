<?php

namespace app\modules\tutorial\models;

use Yii;
use vova07\fileapi\behaviors\UploadBehavior;

/**
 * This is the model class for table "{{%tutorial}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $category_id
 * @property string $description_short
 * @property string $description
 * @property string $logo
 * @property integer $status
 * @property string $alias
 * @property integer $sort_order
 * @property integer $date
 * @property integer $views
 *
 * @property TutorialCategory[] $tutorialCategories
 */
class Tutorial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tutorial}}';
    }
    
    public function behaviors()
    {
        return [
//            'timestampBehavior' => [
//                'class' => TimestampBehavior::className(),
//            ],
//            'sluggableBehavior' => [
//                'class' => SluggableBehavior::className(),
//                'attribute' => 'title',
//                'slugAttribute' => 'alias'
//            ],
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'logo' => [
                        'path' => '@statics/web/tutorial/logo/',
                        'tempPath' => '@statics/temp/tutorial/logo/',
                        'url' => '/statics/tutorial/logo'
                    ],
                ]
            ],
//            'purifierBehavior' => [
//                'class' => PurifierBehavior::className(),
//                'attributes' => [
//                    self::EVENT_BEFORE_VALIDATE => [
//                        'snippet',
//                        'content' => [
//                            'HTML.AllowedElements' => '',
//                            'AutoFormat.RemoveEmpty' => true
//                        ]
//                    ]
//                ],
//                'textAttributes' => [
//                    self::EVENT_BEFORE_VALIDATE => ['title', 'alias']
//                ]
//            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'category_id', 'description_short', 'description', 'logo', 'status', 'alias', 'sort_order', 'date', 'views'], 'required'],
            [['category_id', 'status', 'sort_order', 'date', 'views'], 'integer'],
            [['description_short', 'description'], 'string'],
            [['title', 'alias'], 'string', 'max' => 128],
            [['logo'], 'string', 'max' => 64],
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
            'category_id' => Yii::t('ru', 'Category ID'),
            'description_short' => Yii::t('ru', 'Description Short'),
            'description' => Yii::t('ru', 'Description'),
            'logo' => Yii::t('ru', 'Logo'),
            'status' => Yii::t('ru', 'Status'),
            'alias' => Yii::t('ru', 'Alias'),
            'sort_order' => Yii::t('ru', 'Sort Order'),
            'date' => Yii::t('ru', 'Date'),
            'views' => Yii::t('ru', 'Views'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTutorialCategories()
    {
        return $this->hasMany(TutorialCategory::className(), ['tutorial_id' => 'id']);
    }
}
