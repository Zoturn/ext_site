<?php

namespace app\modules\sproba\models;

use Yii;

/**
 * This is the model class for table "Podija".
 *
 * @property integer $id
 * @property string $Name
 * @property string $description
 * @property string $date
 * @property string $members
 */
class Podija extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Podija';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'Name', 'date', 'members'], 'required'],
            [['id'], 'integer'],
            [['description'], 'string'],
            [['date'], 'safe'],
            [['Name', 'members'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Name' => 'Name',
            'description' => 'Description',
            'date' => 'Date',
            'members' => 'Members',
        ];
    }
}
