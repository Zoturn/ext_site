<?php

namespace app\modules\rooms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rooms\models\Rakeback;

/**
 * RakebackSearch represents the model behind the search form about `app\modules\rooms\models\Rakeback`.
 */
class RakebackSearch extends Rakeback
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'phone', 'fsp', 'rooms', 'status_id'], 'integer'],
            [['name', 'skype', 'email', 'comment', 'type_poker', 'about', 'link'], 'safe'],
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
        $query = Rakeback::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'phone' => $this->phone,
            'fsp' => $this->fsp,
            'rooms' => $this->rooms,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'skype', $this->skype])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'type_poker', $this->type_poker])
            ->andFilterWhere(['like', 'about', $this->about])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}
