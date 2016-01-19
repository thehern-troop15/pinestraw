<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\models\Scoutrelation;
use app\models\Scoutparent;
use app\models\ScoutrelationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ScoutrelationController implements the CRUD actions for Scoutrelation model.
 */
class ScoutrelationController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['login','error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index','create','update','delete'],
                        'allow' => true,
                        'roles' => ['parent','leader'],
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Scoutrelation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ScoutrelationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = Null;

        if (Yii::$app->user->identity->getIsParent()) {
            $thisuser =  Yii::$app->user->getId();
            $parent = Scoutparent::findOne(['userid' => $thisuser]);
            $scoutrelations = Scoutrelation::find()->where(['parentid' => $parent->id])->all();
            $dataProvider = new ActivedataProvider([
                'query' => Scoutrelation::find()->where(['parentid' => $parent->id]),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);
        }


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Scoutrelation model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Scoutrelation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Scoutrelation();

        if ($model->load(Yii::$app->request->post())) {
            $thisuser =  Yii::$app->user->getId();
            $parent = Scoutparent::findOne(['userid' => $thisuser]);

            $model->parentid = $parent->id;

            if ($model->save()) {
                return $this->redirect(['scoutrelation/index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Scoutrelation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing Scoutrelation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Scoutrelation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Scoutrelation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Scoutrelation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
