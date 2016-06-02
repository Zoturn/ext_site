<?php

namespace app\modules\trainings\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\trainings\models\Trainings;

/**
 * TrainingsSearch represents the model behind the search form about `app\modules\trainings\models\Trainings`.
 */
class TrainingsSearch extends Trainings
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'val', 'author_id', 'date', 'type_id', 'limit_id', 'time_start', 'time_end', 'status_id'], 'integer'],
            [['title', 'url', 'description', 'alias', 'password'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Trainings::find();
        
        if(!\Yii::$app->user->can('administrateTrainings')) {
            $query->andFilterWhere(['author_id' => \Yii::$app->user->id]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_DESC,
                ],
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'val' => $this->val,
            'author_id' => $this->author_id,
            'date' => $this->date,
            'type_id' => $this->type_id,
            'status_id' => $this->status_id,
            'limit_id' => $this->limit_id,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'password', $this->password]);

        return $dataProvider;
    }
}
