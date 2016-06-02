<?php

namespace app\modules\rooms\controllers;

use Yii;
use app\modules\rooms\models\Rakeback;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RakebackController implements the CRUD actions for Rakeback model.
 */
class RakebackController extends Controller {

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
     * Displays a single Rakeback model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Rakeback model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Rakeback();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // COOKIES SET
            $qw = Yii::$app->request->get('qw');
            if (empty($qw)) {
                \Yii::$app->response->cookies->add(new \yii\web\Cookie([
                    'name' => 'Rakeback_qw',
                    'value' => \Yii::$app->request->userIP,
                    'expire' => time() + 600,
                ]));
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            // COOKIES GET
            if (($cookie = \Yii::$app->request->cookies->get('Rakeback_qw')) !== null) {
                Yii::$app->session->setFlash('success', Yii::t('ru', 'Заявка отправлена'));
                //return $this->redirect(['index']);
            }
            return $this->render('create', ['model' => $model]);
        }
    }

    /**
     * Deletes an existing Rakeback model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rakeback model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rakeback the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Rakeback::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
