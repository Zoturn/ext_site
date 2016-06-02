<?php

namespace app\modules\video\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\video\models\Video;
use yii\helpers\ArrayHelper;

/**
 * LessonsSearch represents the model behind the search form about `app\modules\video\models\Video`.
 */
class LessonsSearch extends Video {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'val', 'author_id', 'section', 'date', 'duration', 'type_id', 'limit_id', 'comments', 'gp', 'sortOrder'], 'integer'],
            [['title', 'embed', 'description', 'alias', 'ids', 'conspects', 'id_training', 'password', 'tags', 'preview', 'rating'], 'safe'],
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
        $query = Video::find()->where(['section' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'val' => $this->val,
            'author_id' => $this->author_id,
            'section' => $this->section,
            'date' => $this->date,
            'duration' => $this->duration,
            'type_id' => $this->type_id,
            'limit_id' => $this->limit_id,
            'comments' => $this->comments,
            'gp' => $this->gp,
            'sortOrder' => $this->sortOrder,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'embed', $this->embed])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'alias', $this->alias])
                ->andFilterWhere(['like', 'ids', $this->ids])
                ->andFilterWhere(['like', 'conspects', $this->conspects])
                ->andFilterWhere(['like', 'id_training', $this->id_training])
                ->andFilterWhere(['like', 'password', $this->password])
                ->andFilterWhere(['like', 'tags', $this->tags])
                ->andFilterWhere(['like', 'preview', $this->preview])
                ->andFilterWhere(['like', 'rating', $this->rating]);

        return $dataProvider;
    }

    public function getAuthors() {
        $query = Video::find()
                        ->where(['section' => 1])
                        ->joinWith('user')
                        ->orderBy([\nill\users\models\User::tableName() . '.username' => SORT_ASC])->asArray()->all();

        $result = ArrayHelper::map($query, 'author_id', 'user.username');
        return $result;
    }

}
