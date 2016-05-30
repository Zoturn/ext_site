<?php

namespace app\modules\tutorial\models;

use Yii;

/**
 * This is the model class for table "{{%tutorial_category}}".
 *
 * @property integer $id
 * @property integer $tutorial_id
 * @property integer $category_id
 */
class TutorialCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tutorial_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tutorial_id', 'category_id'], 'required'],
            [['tutorial_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tutorial_id' => 'Tutorial ID',
            'category_id' => 'Category ID',
        ];
    }
}
