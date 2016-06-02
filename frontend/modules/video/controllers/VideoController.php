<?php

namespace app\modules\video\controllers;

use Yii;
use app\modules\video\models\Video;
use app\modules\video\models\VideoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\video\models\Videoparsed;
use yii\filters\AccessControl;
use nill\comment_widget\models\CommentsClock;
use app\modules\video\models\VideoRating;
use yii\helpers\Json;

/**
 * VideoController implements the CRUD actions for Video model.
 */
class VideoController extends Controller {

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
            'actions' => ['index', 'view', 'deleteparsed', 'addparsed', 'stat', 'rating', 'getlimits'],
            'roles' => ['ViewVideo']
        ];

        $behaviors['access']['rules'][] = [
            'allow' => true,
            'actions' => ['gift', 'cancel', 'cancel_gift'],
            'roles' => ['createVideo', 'administrateVideo']
        ];

        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['get', 'post'],
                'view' => ['get', 'post'],
                'gift' => ['post'],
                'getlimits' => ['post'],
                'stat' => ['get'],
                'cancel' => ['get'],
                'cancel_gift' => ['get'],
                'rating' => ['get', 'post'],
            ]
        ];

        return $behaviors;
    }

    /**
     * Lists all Video models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new VideoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Video model.
     * @param integer $id
     * @return mixed
     * 
     * Method change for work with aliases
     */
    public function actionView($id = '', $alias = '') {

        // Для работы алиасов внесем условие
        if ($id) {
            $model = $this->findModel($id);
        } elseif ($alias) {
            // Найдем по алиасу
            $model = Video::findOne(['alias' => $alias]);
        }
        
        if(!$model) {throw new \yii\web\HttpException(404);}

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->user->isGuest) {
                Yii::$app->session->setFlash(
                        'success', yii::t('ru', 'Вы не авторизированы')
                );
            } else {
                $model->buy();
            }
//          return $this->refresh();
//          return $this->redirect(['view', 'id' => $model->id]);
            return $this->render('view', [
                        'model' => $model,
            ]);
        } else {
            // Обнулить непрочитанные комментарии
            $comments_clock_model = new CommentsClock();
            $comments_clock_model->reset = $model->id;

            return $this->render('view', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * PJAX ADD VIDEO parsed
     * @param type $id
     */
    public function actionAddparsed($id) {
        if (Yii::$app->request->isPjax && !Yii::$app->user->isGuest) {
            echo Videoparsed::_add($id);
        } else {
            throw new \yii\base\InvalidRouteException('Request is not pjax');
        }
    }

    /**
     * PJAX DELETE VIDEO parsed
     * @param type $id
     */
    public function actionDeleteparsed($id) {
        if (Yii::$app->request->isPjax && !Yii::$app->user->isGuest) {
            echo Videoparsed::_delete($id);
        } else {
            throw new \yii\base\InvalidRouteException('Request is not pjax');
        }
    }

    /**
     * Finds the Video model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Video the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Video::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Подарить
     * @throws \yii\base\InvalidRouteException
     */
    public function actionGift() {
        if (Yii::$app->request->isPjax && Yii::$app->request->post('Video')) {
            echo Video::_gift(Yii::$app->request->post('Video'));
        } else {
            throw new \yii\base\InvalidRouteException('Request is not pjax or empty');
        }
    }

    /**
     * PJAX ADD VIDEO Rating - Рейтинг
     * @param type $id
     * @throws yii\base\InvalidRouteException
     */
    public function actionRating($id, $rating) {
        if (Yii::$app->request->isPjax && !Yii::$app->user->isGuest && Yii::$app->request->get('_pjax') == '#checked_rating') {
            echo VideoRating::_setrating($id, $rating);
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

            $dataProvider = $model->_stat($id);
            $dataProvider_gift = $model->_stat_gift($id);

            return $this->render('buy_stat', [
                        'id' => $id,
                        'dataProvider' => $dataProvider,
                        'dataProvider_gift' => $dataProvider_gift,
                        'is_training' => $model->id_training,
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
