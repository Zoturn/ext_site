<?php

namespace app\modules\rooms\controllers;

use Yii;
use app\modules\rooms\models\RoomsPromo;
use app\modules\rooms\models\RoomsPromoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RoomsPromoController implements the CRUD actions for RoomsPromo model.
 */
class PromoController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all RoomsPromo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoomsPromoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RoomsPromo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id = '', $alias = '') {

        // Для работы алиасов внесем условие
        if ($id) {
            $model = $this->findModel($id);
        } elseif ($alias) {
            // Найдем по алиасу
            $model = RoomsPromo::findOne(['alias' => $alias]);
            if ($model) {
                return $this->render('view', [
                            'model' => $model,
                ]);
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
    }

    /**
     * Finds the RoomsPromo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RoomsPromo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RoomsPromo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
