<?php

namespace app\modules\rooms\controllers;

use Yii;
use app\modules\rooms\models\Rooms;
use app\modules\rooms\models\RoomsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\rooms\models\RoomsAcc;

/**
 * RoomsController implements the CRUD actions for Rooms model.
 */
class RoomsController extends Controller {

    public function behaviors() {
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
     * Lists all Rooms models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new RoomsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rooms model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id = '', $alias = '') {

        // Для работы алиасов внесем условие
        if ($id) {
            $model = $this->findModel($id);
        } elseif ($alias) {
            // Найдем по алиасу
            $model = Rooms::findOne(['alias' => $alias]);
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
     * Finds the Rooms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rooms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Rooms::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * ADD ACCOUNT
     * @throws \yii\base\InvalidRouteException
     */
    public function actionAccount() {
        if (Yii::$app->request->isPjax && !Yii::$app->user->isGuest) {
            $acc = Yii::$app->request->post('Rooms');
            $rooms_account = new RoomsAcc();
            echo $rooms_account->addaccount($acc);
        } else {
            throw new \yii\base\InvalidRouteException('Request is not pjax or empty');
        }
    }

}
