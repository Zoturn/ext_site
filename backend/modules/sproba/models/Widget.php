<?php

namespace app\modules\sproba\models;

use Yii;

/**
 * This is the model class for table "{{%widget}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $info
 * @property string $date
 */
class Widget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%widget}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'info', 'date'], 'required'],
            [['info'], 'string'],
            [['date'], 'safe'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'info' => 'Info',
            'date' => 'Date',
        ];
    }
}
