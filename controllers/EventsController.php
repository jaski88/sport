<?php

namespace app\controllers;

use Yii;
use app\models\Event;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\EventSearch;
use app\models\User;
use app\models\EventUsers;

/**
 * EventsController implements the CRUD actions for Event model.
 */
class EventsController extends Controller {
    
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }
    
    public function actionUser()
    {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search_by_user(Yii::$app->request->queryParams, User::getUserId());
                
        return $this->render('user', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionSignUp( $id )
    {
        $event = $this->findModel( $id );
        if ( $event->hasMaxUsers() )
        {
            return $this->redirect(['view', 'id' => $id]);
//            exit;
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


    /**
     * Displays a single Event model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
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

    /**
     * Updates an existing Event model.
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
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionActivate($id) {
        $model = $this->findModel($id);
        $model->switchActive( );
        $model->save( );
        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
