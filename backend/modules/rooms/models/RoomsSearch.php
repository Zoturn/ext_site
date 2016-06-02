<?php

namespace app\modules\rooms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rooms\models\Rooms;

/**
 * RoomsSearch represents the model behind the search form about `app\modules\rooms\models\Rooms`.
 */
class RoomsSearch extends Rooms
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sortOrder'], 'integer'],
            [['title', 'net', 'alias', 'snippet', 'promo', 'logo', 'content', 'info', 'instruction', 'bonus'], 'safe'],
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
        $query = Rooms::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'sortOrder' => SORT_DESC,
                ],
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'sortOrder' => $this->sortOrder,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'net', $this->net])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'snippet', $this->snippet])
            ->andFilterWhere(['like', 'promo', $this->promo])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'instruction', $this->instruction])
            ->andFilterWhere(['like', 'bonus', $this->bonus]);

        return $dataProvider;
    }
}
