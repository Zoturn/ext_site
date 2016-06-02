<?php

namespace app\modules\rooms\models;

use Yii;

/**
 * This is the model class for table "{{%rooms_acc}}".
 *
 * @property integer $id
 * @property integer $room_id
 * @property integer $user_id
 * @property integer $status_id
 * @property string $nickname
 */
class RoomsAcc extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%rooms_acc}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['room_id', 'user_id', 'nickname'], 'required'],
            [['room_id', 'user_id', 'status_id', 'date'], 'integer'],
            [['nickname'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('ru', 'ID'),
            'room_id' => Yii::t('ru', 'Room ID'),
            'user_id' => Yii::t('ru', 'User ID'),
            'status_id' => Yii::t('ru', 'Status ID'),
            'nickname' => Yii::t('ru', 'Nickname'),
            'date' => Yii::t('ru', 'Date'),
        ];
    }

    /**
     * Привязка аккаунта
     * @param type $params
     * @return string
     */
    public function addaccount($params) {
        $this->nickname = $params['nickname'];
        $this->room_id = $params['id'];
        $this->user_id = \Yii::$app->user->id;
        if ($this->validate()) {
            if ($this->save()) {
                return 'Заявка отправлена';
            } else {
                return 'Ошибка сохранения';
            }
        } else {
            return 'Ошибка валидации';
        }
    }
}
