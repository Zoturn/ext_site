<?php

namespace app\modules\trainings\controllers;

use Yii;
use app\modules\trainings\models\Trainings;
use app\modules\trainings\models\TrainingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\modules\video\models\Video;
use yii\filters\AccessControl;

/**
 * TrainingsController implements the CRUD actions for Trainings model.
 */
class TrainingsController extends Controller {

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
            'actions' => ['index', 'stat', 'view'],
            'roles' => ['ViewVideo']
        ];

        $behaviors['access']['rules'][] = [
            'allow' => true,
            'actions' => ['gift', 'cancel', 'cancel_gift'],
            'roles' => ['administrateVideo']
        ];

        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['get', 'post'],
                'view' => ['get', 'post'],
                'gift' => ['post'],
                'stat' => ['get'],
                'cancel' => ['get'],
                'cancel_gift' => ['get'],
                'rating' => ['get', 'post'],
            ]
        ];

        return $behaviors;
    }

    /**
     * Lists all Trainings models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TrainingsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Trainings model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id = '', $alias = '') {

        // Для работы алиасов внесем условие
        if ($id) {
            $model = $this->findModel($id);
        } elseif ($alias) {
            // Найдем по алиасу
            $model = Trainings::findOne(['alias' => $alias]);
        }

        if ($model->load(\Yii::$app->request->post())) {
            if (Yii::$app->user->isGuest) {
                Yii::$app->session->setFlash(
                        'success', yii::t('ru', 'You are not logged in')
                );
            } else {
                $model->buy();
            }
            $ydate = \Yii::$app->request->post('date');
            return $this->redirect(['index', 'date' => !empty($ydate) ? $ydate : date('d.m.Y')]);
        } else {
            return $this->render('view', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Trainings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Trainings();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Trainings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Trainings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Trainings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Trainings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Trainings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Получить список зависимых от тапа лимитов (вызывется в форме)
     * @return JSON 
     */
    public function actionGetlimits() {
        $out = [];
        $post = Yii::$app->request->post();
        if (isset($post)) {
            $parents = $post['depdrop_parents'];
            if ($parents != null) {
                $type_id = $parents[0];
                $out = Video::getPartLimits($type_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    /**
     * Подарить
     * @throws \yii\base\InvalidRouteException
     */
    public function actionGift() {
        if (Yii::$app->request->isPjax && Yii::$app->request->post('Trainings')) {
            echo Trainings::_gift(Yii::$app->request->post('Trainings'));
        } else {
            throw new \yii\base\InvalidRouteException('Request is not pjax or empty');
        }
    }

    /**
     * Вывод общей статистики для указаного id
     * @param type $id
     * @return mixed
     */
    public function actionStat($id) {
        $model = $this->findModel($id);
        if ($model->_isAuthor || \Yii::$app->user->can('administrateVideo')) {

            $model = new Trainings();
            $dataProvider = $model->_stat($id);
            $dataProvider_gift = $model->_stat_gift($id);

            return $this->render('buy_stat', [
                        'dataProvider' => $dataProvider,
                        'dataProvider_gift' => $dataProvider_gift,
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Отмена покупки видео
     * @param type $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionCancel($id, $target_user_id) {
        if (Yii::$app->request->get()) {
            $model = $this->findModel($id);
            $model->_buy_cancel($target_user_id);
            return $this->redirect(['stat', 'id' => $id]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Отмена дарения видео
     * @param type $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionCancel_gift($id, $to_id) {
        if (Yii::$app->request->get()) {
            $model = $this->findModel($id);
            $model->_gift_cancel($id, $to_id);
            return $this->redirect(['stat', 'id' => $id]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
