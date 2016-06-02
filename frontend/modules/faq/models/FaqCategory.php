<?php

namespace app\modules\faq\models;

use Yii;

/**
 * This is the model class for table "{{%faq_category}}".
 *
 * @property integer $id
 * @property string $title
 */
class FaqCategory extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%faq_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title'], 'required'],
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
        ];
    }

    /*
     * Method for get name of Blogs Category
     * @return array value name Category
     */

    public static function getCategory() {
        return $customers = self::find()
                ->joinWith('category_id')
                ->orderBy(['sortOrder' => SORT_ASC])
//                ->where('category_id')
//                ->distinct(true)
                ->asArray()
                ->all();
    }

    public function getCategory_id() {
        return $this->hasOne(Faq::className(), ['category_id' => 'id']);
    }

}
