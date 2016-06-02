<?php

namespace app\modules\video\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\video\models\VideoUsr;

/**
 * VideoUsrSearch represents the model behind the search form about `app\modules\video\models\VideoUsr`.
 */
class VideoUsrSearch extends VideoUsr
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'video_id', 'user_id'], 'integer'],
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
        $query = VideoUsr::find()->joinWith('videos');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'video_id' => $this->video_id,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }
}
