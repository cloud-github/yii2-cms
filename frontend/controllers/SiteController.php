<?php
namespace frontend\controllers;

use Yii;
use yii\web\ForbiddenHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\PasswordResetRequestForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'login',
                            'request-password-reset',
                            'reset-password',
                            'forbidden',
                            'not-found',
                            'terms',
                        ],
                        'allow'   => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'error'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                    [
                        'actions'       => ['signup'],
                        'allow'         => true,
                        'matchCallback' => function () {
                            //return Option::get('allow_signup') && Yii::$app->user->isGuest;
                        },
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Show user count, post count, post-comment count on index (dashboard).
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Show login page and process login page.
     *
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        // Set layout and bodyClass for login-page
        $this->layout = 'blank';
        Yii::$app->params['bodyClass'] = 'login-page';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model
        ]);
    }

    /**
     * Logout for current user and redirect to home of backend.
     *
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Generate and send token to user's email for resetting password.
     *
     * @return string|\yii\web\Response
     */
    public function actionRequestPasswordReset()
    {
        // Change layout and body class of register page
        $this->layout = 'blank';
        Yii::$app->params['bodyClass'] = 'register-page';
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error','Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('request-password-reset-token', [
            'model' => $model,
        ]);
    }

    /**
     * @throws \yii\web\ForbiddenHttpException
     */
    public function actionForbidden()
    {
        throw new ForbiddenHttpException(Yii::t('yii2-cms', 'You are not allowed to perform this action.'));
    }
    
}
