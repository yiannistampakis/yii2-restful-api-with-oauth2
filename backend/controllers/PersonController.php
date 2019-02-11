<?php

namespace backend\controllers;

use yii\filters\AccessControl;
use app\models\Person;
use backend\behaviours\Verbcheck;
use backend\behaviours\Apiauth;

use Yii;

class PersonController extends RestController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        return $behaviors + [
           'apiauth' => [
               'class' => Apiauth::className(),
               'exclude' => [],
               'callback'=>[]
           ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['sdap'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['sdap-teacher'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['*'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => Verbcheck::className(),
                'actions' => [
                    'index' => ['GET', 'POST'],
                    'create' => ['POST'],
                    'update' => ['PUT'],
                    'view' => ['GET'],
                    'delete' => ['DELETE'],
                    'sdap' => ['GET'],
                    'sdap-teacher' => ['GET']
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $params = $this->request['search'];
        $response = Person::search($params);
        Yii::$app->api->sendSuccessResponse($response['data'], $response['info']);
    }

    /*
     * Serves employees Person's data to Sdap app
     */
    public function actionSdap()
    {
        $params = $this->request['search'];
        $response = Person::searchSdap($params);
        Yii::$app->api->sendSuccessResponse($response['data'], $response['info']);
    }

    /*
     * Serves teachers Person's data to Sdap app
     */
    public function actionSdapTeacher()
    {
        $params = $this->request['search'];
        $response = Person::searchSdapTeacher($params);
        Yii::$app->api->sendSuccessResponse($response['data'], $response['info']);
    }

    public function actionCreate()
    {
        $model = new Person;
        $model->attributes = $this->request;

        if ($model->save()) {
            Yii::$app->api->sendSuccessResponse($model->attributes);
        } else {
            Yii::$app->api->sendFailedResponse($model->errors);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->attributes = $this->request;

        if ($model->save()) {
            Yii::$app->api->sendSuccessResponse($model->attributes);
        } else {
            Yii::$app->api->sendFailedResponse($model->errors);
        }
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        Yii::$app->api->sendSuccessResponse($model->attributes);
    }

    public function actionDelete($id)
    {

        $model = $this->findModel($id);
        $model->delete();
        Yii::$app->api->sendSuccessResponse($model->attributes);
    }

    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        } else {
            Yii::$app->api->sendFailedResponse("Invalid Record requested");
        }
    }
}