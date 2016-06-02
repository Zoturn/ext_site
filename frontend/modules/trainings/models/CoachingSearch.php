<?php

namespace app\modules\trainings\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\trainings\models\Coaching;

/**
 * CoachingSearch represents the model behind the search form about `app\modules\trainings\models\Coaching`.
 */
class CoachingSearch extends Coaching
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'fsp', 'type_id', 'limit_id', 'video_id'], 'integer'],
            [['photo', 'description', 'link', 'link_forum'], 'safe'],
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
        $query = Coaching::find()
                ->joinWith('user');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'fsp' => $this->fsp,
            'type_id' => $this->type_id,
            'limit_id' => $this->limit_id,
            'video_id' => $this->video_id,
        ]);

        $query->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'link_forum', $this->link_forum]);

        return $dataProvider;
    }
}
