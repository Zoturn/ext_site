<?php

namespace app\modules\rooms\models;

use Yii;

/**
 * This is the model class for table "{{%rakeback}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $phone
 * @property string $skype
 * @property string $email
 * @property string $comment
 * @property string $type_poker
 * @property integer $fsp
 * @property integer $rooms
 * @property string $about
 * @property string $link
 * @property integer $status_id
 */
class Rakeback extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%rakeback}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['type_poker'], 'required'],
            [['phone', 'fsp', 'rooms', 'status_id'], 'integer'],
            [['type_poker', 'about'], 'string'],
            [['name', 'about'], 'string'],
            [['email'], 'email'],
            [['name', 'skype', 'email', 'comment', 'link'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('ru', 'ID'),
            'name' => Yii::t('ru', 'Name'),
            'phone' => Yii::t('ru', 'Phone'),
            'skype' => Yii::t('ru', 'Skype'),
            'email' => Yii::t('ru', 'Email'),
            'comment' => Yii::t('ru', 'Your Comment'),
            'type_poker' => Yii::t('ru', 'Type Poker'),
            'fsp' => Yii::t('ru', 'You buy points?'),
            'rooms' => Yii::t('ru', 'Played in partner poker rooms?'),
            'about' => Yii::t('ru', 'How did you hear about Freestylepoker?'),
            'link' => Yii::t('ru', 'Link'),
            'status_id' => Yii::t('ru', 'Status'),
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['admin-create'] = [
            'name',
            'phone',
            'skype',
            'email',
            'comment',
            'type_poker',
            'fsp',
            'rooms',
            'about',
            'link',
            'status_id',
        ];
        $scenarios['admin-update'] = [
            'name',
            'phone',
            'skype',
            'email',
            'comment',
            'type_poker',
            'fsp',
            'rooms',
            'about',
            'link',
            'status_id',
        ];

        return $scenarios;
    }

}
