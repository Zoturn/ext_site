<?php

namespace app\modules\video\models;

use Yii;
use app\modules\video\models\Video;

/**
 * This is the model class for table "{{%video_rating}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $video_id
 * @property integer $rating
 */
class VideoRating extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%video_rating}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'video_id', 'rating'], 'required'],
            [['user_id', 'video_id', 'rating'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('ru', 'ID'),
            'user_id' => Yii::t('ru', 'User ID'),
            'video_id' => Yii::t('ru', 'Video ID'),
            'rating' => Yii::t('ru', 'Rating'),
        ];
    }

    /**
     * Pjax add VIDEO parsed
     * @param type $id
     * @return string
     */
    public static function _setrating($id, $rating) {
        $videorating = new VideoRating();

        $videorating->video_id = $id;
        $videorating->user_id = Yii::$app->user->id;
        $videorating->rating = $rating;
        $videorating->save();

        // Сделаем запись в таблицу Видео
        $all_rating = $videorating::find()
                ->where(['video_id' => $id])
                ->sum('rating');
        $all_rating_count = $videorating::find()
                ->where(['video_id' => $id])
                ->count();
        $result = (empty($all_rating_count)) ? '0' : $all_rating / $all_rating_count;
        
        $video = Video::findOne(['id' => $id]);
        $video->updateAttributes(['rating' => $result]);
        return 'ok';
    }

}
