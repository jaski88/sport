<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use app\components\AccessRule;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\users\PasswordForm;
use app\models\users\PasswordRecoveryForm;
use app\models\users\UserSearch;
use app\models\users\RegisterForm;
use app\models\users\User;

class UsersController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                // We will override the default rule config with the new AccessRule class
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['index', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'create'],
                        'allow' => true,
                        // Allow users, moderators and admins to create
                        'roles' => [
                            User::ROLE_USER,
                            User::ROLE_MODERATOR,
                            User::ROLE_ADMIN
                        ],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        // Allow moderators and admins to update
                        'roles' => [
                            User::ROLE_MODERATOR,
                            User::ROLE_ADMIN
                        ],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        // Allow admins to delete
                        'roles' => [
                            User::ROLE_ADMIN
                        ],
                    ],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'oAuthSuccess'],
            ],
        ];
    }

    public function oAuthSuccess($client) {
        $userAttr = $client->getUserAttributes();
        $id = $userAttr['id'];

        if (User::loginByFb($id)) {
            $this->goHome();
        } else {
            Yii::$app->session->set('id', $id);
            Yii::$app->session->set('name', $userAttr['name']);
            Yii::$app->session->set('email', $userAttr['email']);
            Yii::$app->session->set('name', $userAttr['first_name']);
            Yii::$app->session->set('surname', $userAttr['last_name']);

            return $this->redirect(['fb-register']);
        }
    }

    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSearch() {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('search', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate() {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

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

    public function actionMyAccount() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('my-account', [
                    'model' => $this->findModel(User::getUserId()),
        ]);
    }

    public function actionPassword() {

        if (Yii::$app->user->identity->isFbUser()) {
            return $this->redirect(['my-account']);
        }

        $model = new PasswordForm( );
        if ($model->load(Yii::$app->request->post()) && $model->updatePassword()) {
            return $this->redirect(['my-account']);
        }
        return $this->render('password', [
                    'model' => $model,
        ]);
    }

    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionLocation() {
        $model = $this->findModel(User::getUserId());

        if ($model->load(Yii::$app->request->post()) && $model->save(true, array('coords', 'address', 'region_id'))) {
            return $this->redirect(['site/my-account']);
        } else {
            return $this->render('location', [
                        'model' => $model,
            ]);
        }
    }

    public function actionFbRegister() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $id = Yii::$app->session->get('id');

        if ($id === null) {
            return $this->redirect(['users/auth?authclient=facebook']);
        }

        $model = new User();
        $model->setScenario('facebook');

        $email = Yii::$app->session->get('email');
        $username = explode('@', $email)[0];

        $model->fb_id = $id;
        $model->name = Yii::$app->session->get('name');
        $model->surname = Yii::$app->session->get('surname');
        $model->username = $username;
        $model->email = $email;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {

                if ($model->save() && User::loginByFb($model->fb_id)) {
                    return $this->redirect(['users/my-account']);
                }
            }
        }

        return $this->render('register_fb', [
                    'model' => $model,
        ]);
    }

    public function actionRegister() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {

                $model->password = User::hashPassword($model->password);
                $model->role = User::ROLE_USER;

                if ($model->save(false) && $model->login()) {
                    return $this->redirect(['users/my-account']);
                }
            }
        }

        return $this->render('register', [
                    'model' => $model,
        ]);
    }

    public function actionPasswordRecover() {
        $model = new PasswordRecoveryForm();

        if ($model->load(Yii::$app->request->post()) && $model->send()) {
            Yii::$app->session->setFlash('formSubmitted');
        }

        return $this->render('password_recover', [
                    'model' => $model,
        ]);
    }

    public function actionTokenLogin($token) {

        $user = User::findOne(['token' => $token]);

        $success = false;

        if ($user) {
            $user->token = '';
            $pass = User::generatePassword();
            $user->password = User::hashPassword($pass);
            $user->save(false);

            Yii::$app->mailer->compose()
                    ->setTo($user->email)
                    ->setFrom([Yii::$app->params['no_reply_email'] => 'TeamMates'])
                    ->setSubject('Zmiana hasła')
                    ->setTextBody('Nowe hasło to: ' . $pass)
                    ->send();

            $success = true;
        }

        return $this->render('token_login', ['success' => $success]);
    }

    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
