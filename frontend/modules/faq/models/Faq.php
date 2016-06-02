<?php

namespace app\modules\faq\models;

use Yii;

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
    public function rules() {
        return [
            [['title', 'text', 'category_id'], 'required'],
            [['text', 'name'], 'string'],
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
            'category_id' => Yii::t('ru', 'Category ID'),
        ];
    }

    public function search($category) {
        
        $cat_id = FaqCategory::findOne(['sortOrder' => 0])->id;

        return self::find()
                ->where('category_id=:category_id', [':category_id' => isset($category['category']) ? $category['category'] : $cat_id])
                ->orderBy(['sortOrder' => SORT_ASC])
                ->all();
    }

}
