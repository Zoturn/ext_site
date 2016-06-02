<?php

namespace app\modules\faq\models;

use Yii;
use vova07\base\behaviors\PurifierBehavior;
use himiklab\sortablegrid\SortableGridBehavior;

/**
 * This is the model class for table "{{%faq}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property integer $category_id
 */
class Faq extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%faq}}';
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'sort' => [
                'class' => SortableGridBehavior::className(),
                'sortableAttribute' => 'sortOrder'
            ],
//            'purifierBehavior' => [
//                'class' => PurifierBehavior::className(),
//                'attributes' => [
//                    self::EVENT_BEFORE_VALIDATE => [
//                        'title',
//                        'text' => [
//                            'HTML.AllowedElements' => '',
//                            'AutoFormat.RemoveEmpty' => true
//                        ]
//                    ]
//                ],
//                'textAttributes' => [
//                    self::EVENT_BEFORE_VALIDATE => ['text' , 'title']
//                ]
//            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'text', 'category_id'], 'required'],
            [['text'], 'string'],
            [['sortOrder'], 'integer'],
            [['category_id'], 'integer'],
            [['title'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('ru', 'ID'),
            'title' => Yii::t('ru', 'Title'),
            'text' => Yii::t('ru', 'Text'),
            'category_id' => Yii::t('ru', 'Category'),
            'sortOrder' => Yii::t('ru', 'O'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['admin-create'] = [
            'title',
            'text',
            'category_id',
            'sortOrder',
        ];
        $scenarios['admin-update'] = [
            'title',
            'text',
            'category_id',
            'sortOrder',
        ];

        return $scenarios;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory() {
        return $this->hasOne(FaqCategory::className(), ['id' => 'category_id']);
    }

}
