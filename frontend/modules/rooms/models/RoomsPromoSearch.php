<?php

namespace app\modules\rooms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rooms\models\RoomsPromo;

/**
 * RoomsPromoSearch represents the model behind the search form about `app\modules\rooms\models\RoomsPromo`.
 */
class RoomsPromoSearch extends RoomsPromo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'text', 'alias', 'img'], 'safe'],
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
        $query = RoomsPromo::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'img', $this->img]);

        return $dataProvider;
    }
}
