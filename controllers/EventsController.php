<?php

namespace app\controllers;

use Yii;
use app\models\Event;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\EventSearch;
use app\models\users\User;
use app\models\EventUsers;

class EventsController extends Controller {
    
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }
        
    public function actionUser( $id )
    {
        
        $user = User::findIdentity($id);
        
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->searchByUser(Yii::$app->request->queryParams, $id);
                
        return $this->render('user', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'user' => $user,
        ]);
    }
    
    public function actionMy( )
    {
        $id = User::getUserId();
        $user = User::findIdentity($id);
        
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->searchByUser(Yii::$app->request->queryParams, $id);
        
        $userEvents = $user->events;
                
        return $this->render('my', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'user' => $user,
            'userEvents' => $userEvents,
        ]);
        
        
    }
    
    public function actionSignUp( $id )
    {
        $event = $this->findModel( $id );
        if ( $event->hasMaxUsers() )
        {
            return $this->redirect(['view', 'id' => $id]);
        }
        
        $model = new EventUsers( );
        $model->user_id = User::getUserId();
        $model->event_id = $id;
        $model->status = EventUsers::STATUS_ACTIVE;
        if ( $model->save())
        {
            return $this->redirect(['view', 'id' => $id]);
        }
        else
        {
            echo 'error';exit;
        }
    }
    
    public function actionSignOut( $id )
    {
        EventUsers::findOne(['user_id' => User::getUserId(), 'event_id' => $id])->delete();
        $this->redirect(['view', 'id' => $id]);
    }

    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate() {
        $model = new Event();
        $model->user_id = User::getUserId();

        if ($model->load(Yii::$app->request->post())) {
            $result = $model->save();
            if ($result === true) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefault();
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
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

    public function actionDelete($id) {
        $model = $this->findModel($id);
        $model->status = Event::STATUS_DELETED;
        $model->save( );

        return $this->redirect(['index']);
    }
    
    public function actionActivate($id) {
        $model = $this->findModel($id);
        $model->switchActive( );
        $model->save( );
        return $this->redirect(['view', 'id' => $model->id]);
    }

    protected function findModel($id) {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
