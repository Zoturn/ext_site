<?php

namespace app\modules\test\models;

use Yii;

/**
 * This is the model class for table "{{%module}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $text
 * @property string $sortOrder
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%module}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'text'], 'required'],
            [['text'], 'string'],
            [['sortOrder'], 'integer'],
            ['sortOrder', 'unique'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Заголовок'),
            'text' => Yii::t('app', 'Описание'),
            'sortOrder' => Yii::t('app', 'Порядок'),
        ];
    }
}
