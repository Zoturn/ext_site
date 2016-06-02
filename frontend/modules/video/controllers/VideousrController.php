<?php

namespace app\modules\video\controllers;

use Yii;
use app\modules\video\models\VideoUsrSearch;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * VideoUsrController implements the CRUD actions for VideoUsr model.
 */
class VideousrController extends Controller
{
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
     * Lists all VideoUsr models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VideoUsrSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
