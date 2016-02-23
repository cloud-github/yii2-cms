<?php
/**
 * @file      PostController.php.
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\ForbiddenHttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
/* MODEL */
use common\models\Post;
use common\models\PostType;
use common\models\search\Post as PostSearch;

/**
 * PostController implements the CRUD actions for Post model.
 *
 * @package backend\controllers
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @since   1.0.0
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            /*'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'bulk-action', 'ajax-search'],
                        'allow'   => true,
                        'roles'   => ['admin']
                    ],
                ],
            ],*/
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete'      => ['post'],
                    'bulk-action' => ['post'],
                    'ajax-search' => ['post']
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     *
     * @param integer     $post_type
     * @param null|string $user
     *
     * @throws \yii\web\ForbiddenHttpException
     * @throws \yii\web\NotFoundHttpException
     * @return mixed
     */

    public function actionIndex($post_type, $user = null)
    {
        $postType = $this->findPostType($post_type);
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $post_type, $user);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'postType'     => $postType,
            'user'         => $user
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'update' page.
     *
     * @param integer $post_type post_type_id
     *
     * @throws \yii\web\ForbiddenHttpException
     * @throws \yii\web\NotFoundHttpException
     * @return mixed
     */

    public function actionCreate($post_type)
    {
        $model = new Post();
        $postType = $this->findPostType($post_type);

        if ($model->load(Yii::$app->request->post())) {
            $model->post_type = $postType->id;
            $model->post_date = Yii::$app->formatter->asDatetime($model->post_date, 'php:Y-m-d H:i:s');
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('yii2-cms', '{post_type} successfully saved.', [
                    'post_type' => $postType->post_type_sn,
                ]));
                return $this->redirect(['post/index', 'post_type' => $model->post_type]);
            }
        }

        return $this->render('create', [
            'model'    => $model,
            'postType' => $postType,
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @throws \yii\web\ForbiddenHttpException
     * @throws \yii\web\NotFoundHttpException
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $postType = $model->postType;

        if ($model->load(Yii::$app->request->post())) {
            $model->post_date = Yii::$app->formatter->asDatetime($model->post_date, 'php:Y-m-d H:i:s');
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('yii2-cms', '{post_type} successfully saved.', [
                    'post_type' => $postType->post_type_sn,
                ]));
                return $this->redirect(['post/index', 'post_type' => $model->post_type]);
            }
        }

        return $this->render('update', [
            'model'    => $model,
            'postType' => $postType
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @throws \Exception
     * @throws \yii\web\ForbiddenHttpException
     * @throws \yii\web\NotFoundHttpException
     * @return mixed
     */

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['index', 'post_type' => $model->post_type]);
    }

    /**
     * Bulk Action for Posts
     */

    public function actionBulkAction()
    {
        if (Yii::$app->request->post('action') === 'delete') {
            foreach (Yii::$app->request->post('ids') as $id) {
                $model = $this->findModel($id);
                $model->delete();
        }
        } else if (Yii::$app->request->post('action') === 'publish') {
            foreach (Yii::$app->request->post('ids') as $id) {
                $this->findModel($id)->updateAttributes(['post_status' => 'publish']);
            }
        } else if (Yii::$app->request->post('action') === 'unpublish') {
            foreach (Yii::$app->request->post('ids') as $id) {
                $this->findModel($id)->updateAttributes(['post_status' => 'unpublish']);
            }
        }
    }

    /**
     * Search posts via ajax.
     */

    public function actionAjaxSearch()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $query = Post::find()
            ->select(['id', 'post_title'])
            ->andWhere(['LIKE', 'post_title', Yii::$app->request->post('post_title')])
            ->limit(10);
        if ($post_type = Yii::$app->request->post('post_type')) {
            $query->andWhere(['post_type' => Yii::$app->request->post('post_type')]);
        }

        return $model = $query->all();

    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the PostType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return PostType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findPostType($id)
    {
        if (($model = PostType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}