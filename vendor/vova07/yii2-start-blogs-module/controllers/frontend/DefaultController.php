<?php

namespace vova07\blogs\controllers\frontend;

use vova07\blogs\models\frontend\Blog;
use vova07\blogs\models\backend\Blog as BlogAdmin;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\HttpException;

/**
 * Default controller.
 */
class DefaultController extends Controller {

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
            'actions' => ['index', 'view', 'create', 'blogs'],
            'roles' => ['viewBlogs']
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['get'],
                'view' => ['get']
            ]
        ];

        return $behaviors;
    }

    /**
     * Blog list page.
     */
    function actionIndex($category='') {
        $query = Blog::find()->published();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $this->module->recordsPerPage
            ]
        ]);
        if(!empty($category)) {
            $query->where(['category_id' => $category]);
        }

        return $this->render('index', [
                    'dataProvider' => $dataProvider
        ]);
    }
    
    /**
     * Blog list page.
     */
    function actionBlogs() {
        $query = Blog::find()->published();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $this->module->recordsPerPage
            ]
        ]);

        $query->where(['author_id' => Yii::$app->user->id]);

        return $this->render('blogs', [
                    'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Blog page.
     *
     * @param integer $id Blog ID
     * @param string $alias Blog alias
     *
     * @return mixed
     *
     * @throws \yii\web\HttpException 404 if blog was not found
     */
    public function actionView($id, $alias) {
        if (($model = Blog::findOne(['id' => $id, 'alias' => $alias])) !== null) {
            $this->counter($model);

            return $this->render('view', [
                        'model' => $model
            ]);
        } else {
            throw new HttpException(404);
        }
    }
    
    /**
     * Create post page.
     */
    public function actionCreate()
    {
        $model = new BlogAdmin(['scenario' => 'admin-create']);
        $statusArray = BlogAdmin::getStatusArray();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save(false)) {
                    return $this->redirect(['index']);
                } else {
                    Yii::$app->session->setFlash('danger', Module::t('blogs', 'BACKEND_FLASH_FAIL_ADMIN_CREATE'));
                    return $this->refresh();
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render('create', [
                'model' => $model,
                'statusArray' => $statusArray
            ]);
    }

    /**
     * Update blog views counter.
     *
     * @param Blog $model Model
     */
    protected function counter($model) {
        $cookieName = 'blogs-views';
        $shouldCount = false;
        $views = Yii::$app->request->cookies->getValue($cookieName);

        if ($views !== null) {
            if (is_array($views)) {
                if (!in_array($model->id, $views)) {
                    $views[] = $model->id;
                    $shouldCount = true;
                }
            } else {
                $views = [$model->id];
                $shouldCount = true;
            }
        } else {
            $views = [$model->id];
            $shouldCount = true;
        }

        if ($shouldCount === true) {
            if ($model->updateViews()) {
                Yii::$app->response->cookies->add(new Cookie([
                    'name' => $cookieName,
                    'value' => $views,
                    'expire' => time() + 86400 * 365
                ]));
            }
        }
    }

}
