<?php

namespace app\modules\faq\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\faq\models\Faq;

/**
 * FaqSearch represents the model behind the search form about `app\modules\faq\models\Faq`.
 */
class FaqSearch extends Faq {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'category_id'], 'integer'],
            [['title', 'text'], 'safe'],
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
    public function search($params, $category) {
        $query = Faq::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andFilterWhere(['like', 'category_id', $category]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
        ]);


        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }

}
