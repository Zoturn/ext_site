<?php

namespace app\modules\tutorial\models;

use Yii;

/**
 * This is the model class for table "{{%categoty_of_tutorials}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $sort_order
 */
class CategotyOfTutorials extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%categoty_of_tutorials}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'sort_order'], 'required'],
            [['sort_order'], 'integer'],
            [['title'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'sort_order' => 'Sort Order',
        ];
    }
}
