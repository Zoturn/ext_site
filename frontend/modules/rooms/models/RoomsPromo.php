<?php

namespace app\modules\rooms\models;

use Yii;

/**
 * This is the model class for table "{{%rooms_promo}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $text
 * @property string $alias
 * @property string $img
 */
class RoomsPromo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rooms_promo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'text', 'alias', 'img'], 'required'],
            [['text'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['alias'], 'string', 'max' => 100],
            [['img'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ru', 'ID'),
            'name' => Yii::t('ru', 'Name'),
            'text' => Yii::t('ru', 'Text'),
            'alias' => Yii::t('ru', 'Alias'),
            'img' => Yii::t('ru', 'Img'),
        ];
    }
}
