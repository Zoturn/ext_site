<?php

namespace app\modules\trainings\controllers;

use Yii;
use app\modules\trainings\models\Trainings;
use app\modules\trainings\models\TrainingsSearch;
use vova07\admin\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\modules\video\models\Video;

/**
 * TrainingsController implements the CRUD actions for Trainings model.
 */
class TrainingsController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['access']['rules'] = [
            [
                'allow' => true,
                'actions' => ['index', 'view'],
                'roles' => ['BViewTrainings']
            ]
        ];
        $behaviors['access']['rules'][] = [
            'allow' => true,
            'actions' => ['create'],
            'roles' => ['BCreateTrainings']
        ];
        $behaviors['access']['rules'][] = [
            'allow' => true,
            'actions' => ['update'],
            'roles' => ['BUpdateTrainings']
        ];
        $behaviors['access']['rules'][] = [
            'allow' => true,
            'actions' => ['delete', 'batch-delete'],
            'roles' => ['BDeleteTrainings']
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['get'],
                'create' => ['get', 'post'],
                'update' => ['get', 'put', 'post'],
                'delete' => ['post', 'delete'],
                'batch-delete' => ['post', 'delete']
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
        $statusArray = Trainings::getStatusArray();

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'statusArray' => $statusArray
        ]);
    }

    /**
     * Displays a single Trainings model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Trainings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Trainings(['scenario' => 'admin-create']);
        $statusArray = Trainings::getStatusArray();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('ru', 'TRAINING CREATE SUCCESSFUL'));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'statusArray' => $statusArray
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
        $model->setScenario('admin-update');
        $statusArray = Trainings::getStatusArray();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('ru', 'TRAINING UPDATE SUCCESSFUL'));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'statusArray' => $statusArray
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

}
