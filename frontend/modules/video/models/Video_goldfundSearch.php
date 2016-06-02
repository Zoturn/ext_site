<?php

namespace app\modules\video\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Video_goldfundSearch represents the model behind the search form about `app\modules\video\models\Video_goldfund`.
 */
class Video_goldfundSearch extends Video {

    public $is_buy;
    public $is_parsed;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'val', 'author_id', 'section', 'date', 'duration', 'type_id', 'limit_id', 'comments', 'gp', 'sortOrder', 'is_buy', 'is_parsed',], 'integer'],
            [['title', 'embed', 'description', 'alias', 'ids', 'conspects', 'id_training', 'password', 'tags', 'preview'], 'safe'],
        ];
    }

    public function attributeLabels() {
        parent::attributeLabels();
        return [
            'is_buy' => Yii::t('ru', 'Is Buy'),
            'is_parsed' => Yii::t('ru', 'Is Parsed'),
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $i = 0, $p = false) {

        $query = Video::find()->orderBy('sortOrder')->where(['type_id' => $i, 'gp' => 1]);

        // Процент доступности
        if ($p === true) {
            $all_count = $query->count();
            $is_buy = isset(Yii::$app->user->id) ?
                    $query->joinWith(['videoUsr'])->andWhere([VideoUsr::tableName() . '.user_id' => Yii::$app->user->id])->count() : 0;
            $free = $query->where(['val' => 0, 'type_id' => $i, 'gp' => 1])->count();

            if ($all_count != 0) {
                $sum = ($free + $is_buy) / $all_count;
                $percent = $sum * 100;
                return round($percent);
            }
            return '0';
        }

        $query = $query->joinWith(['videoparsed']);

        $query = $query->with(['limit']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 1000,
            ]
        ]);

        if (!($this->load($params, '') && $this->validate())) {
            return $dataProvider;
        }

        if ($this->is_buy && !Yii::$app->user->isGuest) {
            $query->joinWith(['videoUsr'])->andFilterWhere([VideoUsr::tableName() . '.user_id' => Yii::$app->user->id]);
            $query->joinWith(['trainingsUsr'])->orFilterWhere([\app\modules\trainings\models\TrainingsUsr::tableName()
                . '.user_id' => Yii::$app->user->id, 'type_id' => $i, 'gp' => 1]);
        }

        if ($this->is_parsed && !Yii::$app->user->isGuest) {
            $query->joinWith(['videoparsed'])->andFilterWhere([Videoparsed::tableName() . '.user_id' => Yii::$app->user->id]);
        }

        return $dataProvider;
    }

    public function getVideoTypeCount() {
        return \app\modules\video\models\VideoType::find()->count();
    }

}
