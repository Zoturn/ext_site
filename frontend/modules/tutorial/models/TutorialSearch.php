<?php

namespace app\modules\tutorial\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\tutorial\models\Tutorial;

/**
 * TutorialSearch represents the model behind the search form about `app\modules\tutorial\models\Tutorial`.
 */
class TutorialSearch extends Tutorial
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'status', 'sort_order', 'date', 'views'], 'integer'],
            [['title', 'description_short', 'description', 'preview_url', 'alias'], 'safe'],
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
        $query = Tutorial::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([            
            'category_id' => $this->category_id,            
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->orFilterWhere(['like', 'description_short', $this->title])
            ->orFilterWhere(['like', 'description', $this->title]);
            

        return $dataProvider;
    }
}
