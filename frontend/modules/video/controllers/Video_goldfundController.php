<?php

namespace app\modules\video\controllers;

use Yii;
use app\modules\video\models\Video_goldfundSearch;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * Video_goldfundController implements the CRUD actions for Video_goldfund model.
 */
class Video_goldfundController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        $behaviors = parent::behaviors();

        if (!isset($behaviors['access']['class'])) {
            $behaviors['access']['class'] = AccessControl::className();
        }
        
        $behaviors['access']['rules'][] = [
            'allow' => true,
            'actions' => ['index'],
            'roles' => ['ViewVideo']
        ];
        
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['get'],
            ]
        ];

        return $behaviors;
    }
    
    /**
     * Lists all Video_goldfund models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new Video_goldfundSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
}
