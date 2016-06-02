<?php

namespace app\modules\video\models;

use Yii;
use yii\data\ActiveDataProvider;
use app\modules\video\models\VideoUsr;
use app\modules\video\models\Video;
use yii\web\NotFoundHttpException;

/**
 * VideoUsrSearch represents the model behind the search form about `app\modules\video\models\VideoUsr`.
 */
class VideoUsrSearch extends VideoUsr {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'video_id', 'user_id'], 'integer'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {

        if (!Yii::$app->user->isGuest) {

            $query = Video::find()
                    ->joinWith(['videoUsr'])
                    ->select(['title', 'val'])
                    ->where(['user_id' => Yii::$app->user->id])
                    ->union("SELECT `fsp_core_trainings`.title, `fsp_core_trainings`.val FROM `fsp_core_trainings` "
                    . "LEFT JOIN `fsp_core_trainings_usr` ON `fsp_core_trainings`.`id` = `fsp_core_trainings_usr`.`training_id` "
                    . "WHERE `user_id`=" . Yii::$app->user->id);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            if (!($this->load($params) && $this->validate())) {
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'video_id' => $this->video_id,
                'user_id' => $this->user_id,
            ]);

            return $dataProvider;
        } else {
            throw new NotFoundHttpException('Эта страница доступна только зарегистрированым пользователям!');
        }
    }

}
