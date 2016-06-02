<?php

namespace app\modules\video\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\video\models\Video;

/**
 * VideoSearch represents the model behind the search form about `app\modules\video\models\Video`.
 */
class VideoSearch extends Video {

    public function init() {
        parent::init();
        $this->date = '';
    }

    public $type;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'val', 'author_id', 'section', 'duration', 'id_training', 'comments', 'gp'], 'integer'],
            [['title', 'limit_id', 'type_id', 'embed', 'description', 'alias', 'ids', 'date', 'conspects', 'password', 'tags', 'preview'], 'safe'],
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
        $query = Video::find()->joinWith(['type'])->joinWith(['limit']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => 10,
                'pageSizeLimit' => 1000,
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

//        $dataProvider->sort->attributes['name'] = [
//            'asc' => [VideoType::tableName() . '.name' => SORT_ASC],
//            'desc' => [VideoType::tableName() . '.name' => SORT_DESC]
//        ];


        if (!empty($this->date)) {
            $this->date = Yii::$app->formatter->asTimestamp($this->date);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'val' => $this->val,
            'author_id' => $this->author_id,
            'section' => $this->section,
            'date' => $this->date,
            'duration' => $this->duration,
            'id_training' => $this->id_training,
            'comments' => $this->comments,
            'gp' => $this->gp,
        ]);

        $query->andFilterWhere(['like', VideoType::tableName() . '.name', $this->type_id]);
        $query->andFilterWhere(['like', VideoLimits::tableName() . '.name', $this->limit_id]);
        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'embed', $this->embed])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'alias', $this->alias])
                ->andFilterWhere(['like', 'ids', $this->ids])
                ->andFilterWhere(['like', 'conspects', $this->conspects])
                ->andFilterWhere(['like', 'password', $this->password])
                ->andFilterWhere(['like', 'tags', $this->tags])
                ->andFilterWhere(['like', 'preview', $this->preview])
                ->andFilterWhere(['like', 'author_id', $this->author_id]);

        return $dataProvider;
    }

}
