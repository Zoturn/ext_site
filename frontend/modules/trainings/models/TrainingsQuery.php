<?php

namespace app\modules\trainings\models;

use app\modules\trainings\traits\ModuleTrait;
use yii\db\ActiveQuery;

/**
 * Class BlogQuery
 * @package vova07\blog\models
 */
class TrainingsQuery extends ActiveQuery
{
    use ModuleTrait;

    /**
     * Select published posts.
     *
     * @return $this
     */
    public function published()
    {
        $this->andWhere(['status_id' => Trainings::STATUS_PUBLISHED]);

        return $this;
    }

    /**
     * Select unpublished posts.
     *
     * @return $this
     */
    public function unpublished()
    {
        $this->andWhere(['status_id' => Trainings::STATUS_UNPUBLISHED]);

        return $this;
    }
}
