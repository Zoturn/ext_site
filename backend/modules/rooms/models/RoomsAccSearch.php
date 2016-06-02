<?php

namespace app\modules\rooms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rooms\models\RoomsAcc;
use nill\users\models\User;

/**
 * RoomsAccSearch represents the model behind the search form about `app\modules\rooms\models\RoomsAcc`.
 */
class RoomsAccSearch extends RoomsAcc {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'status_id'], 'integer'],
            [['room_id', 'user_id', 'nickname'], 'safe'],
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
        $query = RoomsAcc::find()
                ->joinWith('user')
                ->joinWith('room');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            self::tableName() . '.id' => $this->id,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', User::tableName() . '.username', $this->user_id]);
        $query->andFilterWhere(['like', Rooms::tableName() . '.title', $this->room_id]);
        $query->andFilterWhere(['like', 'nickname', $this->nickname]);

        return $dataProvider;
    }

}
