<?php

namespace app\modules\sproba\controllers;

use yii\web\Controller;

/**
 * Default controller for the `Sproba1` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new \app\modules\sproba\models\Widget();
        $data = $model->findAll(['name'=>'Zoturn']);
        return $this->render('index', ['data'=>$data, 'test'=>1]);
    }
}
