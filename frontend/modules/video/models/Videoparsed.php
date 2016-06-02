<?php

namespace app\modules\video\models;

use Yii;

/**
 * This is the model class for table "{{%video_parsed}}".
 *
 * @property integer $id
 * @property integer $video_id
 * @property integer $user_id
 */
class Videoparsed extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%video_parsed}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['video_id', 'user_id'], 'required'],
            [['video_id', 'user_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('ru', 'ID'),
            'video_id' => Yii::t('ru', 'Video ID'),
            'user_id' => Yii::t('ru', 'User ID'),
        ];
    }

    /**
     * Pjax add VIDEO parsed
     * @param type $id
     * @return string
     */
    public static function _add($id) {
        $videoparsed = new Videoparsed();

        // Присваевам атрибуты и сохраняем (делаем запись)
        $videoparsed->video_id = $id;
        $videoparsed->user_id = Yii::$app->user->id;
        $videoparsed->save();
        return '<i class="icon-check"> </i>'
                . \yii\helpers\Html::a(
                        'Разобранное', ['deleteparsed', 'id' => $id], ['data-pjax' => '#checked-parsed' . $id]);
    }

    /**
     * Pjax delete VIDEO parsed
     * @param type $id
     * @return string
     */
    public static function _delete($id) {
        $videoparsed = self::findOne(['video_id' => $id, 'user_id' => Yii::$app->user->id]);
        if ($videoparsed != NULL) {
            $videoparsed->delete();
            return '<i class="icon-check-empty"> </i>'
                . \yii\helpers\Html::a(
                        'Разобранное', ['addparsed', 'id' => $id], ['data-pjax' => '#checked-parsed' . $id]);
        } else {
            throw new \yii\db\Exception('This record does not exist.');
        }
    }

}
