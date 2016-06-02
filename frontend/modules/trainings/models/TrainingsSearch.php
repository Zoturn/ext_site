<?php

namespace app\modules\trainings\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\trainings\models\Trainings;
use DateTime;

/**
 * TrainingsSearch represents the model behind the search form about `app\modules\trainings\models\Trainings`.
 */
class TrainingsSearch extends Trainings {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'val', 'author_id', 'type_id', 'limit_id', 'time_start', 'time_end'], 'integer'],
            [['title', 'url', 'date', 'description', 'alias', 'password'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {

        $query = Trainings::find()->published();

//        if (!($this->load($params) && $this->validate())) {
//            return $dataProvider;
//        }
        if (isset($params['date'])) {
            if (!isset($params['TrainingsSearch']))
                $params['TrainingsSearch'] = array();
            $params['TrainingsSearch']['date'] = $params['date'];
            unset($params['date']);
        }
        $this->load($params);

        if ($this->date != Null) {
            $date_start = Yii::$app->formatter->asTimestamp($this->date);
            // Прибавить 7 дней к полученой дате
            $date_end = new DateTime($this->date);
            $date_end->modify('+7 day');
            $date_end->format('d.m.Y');
            $date_end = Yii::$app->formatter->asTimestamp($date_end);
            $query->andFilterWhere(['between', 'date', $date_start, $date_end]);
        } else {
            $date = date('d.m.Y');
            $date_start = Yii::$app->formatter->asTimestamp($date);
            // Прибавить 7 дней к текущей дате
            $date_end = new DateTime($date);
            $date_end->modify('+7 day');
            $date_end->format('d.m.Y');
            $date_end = Yii::$app->formatter->asTimestamp($date_end);
            $query->andFilterWhere(['between', 'date', $date_start, $date_end]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'val' => $this->val,
            'author_id' => $this->author_id,
            'type_id' => $this->type_id,
            'limit_id' => $this->limit_id,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'url', $this->url])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'alias', $this->alias])
                ->andFilterWhere(['like', 'password', $this->password]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_ASC,
                    'time_start' => SORT_ASC,
                ],
            ],
        ]);
        return $dataProvider;
    }

}
