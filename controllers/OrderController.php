<?php

namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Order;
use app\models\Scoutrelation;
use app\models\Scoutparent;
use app\models\Scout;
use app\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['logout'],
                'rules' => [
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
                        'actions' => ['create','index','update'],
                        'allow' => true,
                        'roles' => ['parent','scout','leader'],
                    ],
                    [
                        'actions' => ['createany','delete'],
                        'allow' => true,
                        'roles' => ['leader'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin'],
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = Null;
        $searchModel = new OrderSearch();

        if (Yii::$app->user->identity->getIsScout()) {
            $thisuser =  Yii::$app->user->getId();
            $scout = Scout::findOne(['userid' => $thisuser]);
            $query = new Query();
            $query->andFilterWhere(['scoutid' => $scout->id]);
            $dataProvider = new ActivedataProvider([
                'query' => Order::find(),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);
        } elseif (Yii::$app->user->identity->getIsLeader()) {
            $query = new Query();
            $dataProvider = new ActivedataProvider([
                'query' => Order::find(),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);
        } elseif (Yii::$app->user->identity->getIsParent()) {
            $thisuser =  Yii::$app->user->getId();
            $parent = Scoutparent::findOne(['userid' => $thisuser]);
            $scoutrelations = Scoutrelation::find()->where(['parentid' => $parent->id])->all();

            $query = new Query();
            $query->andFilterWhere(['scoutid' => ArrayHelper::getColumn($scoutrelations, ['scoutid'])]);
            $dataProvider = new ActivedataProvider([
                'query' => Order::find(),
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
     * Displays a single Order model.
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
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->user->identity->getIsParent()) {
                $order = Yii::$app->request->post('Order');
                $scoutid = $order['scoutid'];
                $scoutrelation = Scoutrelation::find()->where(['id' => $scoutid])->one();
                $result = $scoutrelation->getAttributes(['scoutid']);

                $model->setAttribute('scoutid', $result['scoutid']);
            }

            if ($model->save()) {
                return $this->redirect(['/site/index', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            if (Yii::$app->user->identity->getIsScout()) {
                $thisuser =  Yii::$app->user->getId();
                $scout = Scout::findOne(['userid' => $thisuser]);
                $scoutlist = ArrayHelper::map(Scout::findAll(['id' => $scout->id]), 'id', 'name');
            } elseif (Yii::$app->user->identity->getIsParent()) {
                $scoutlist = ArrayHelper::map(Scoutrelation::find()->all(), 'id', 'scout.name');
            } elseif (Yii::$app->user->identity->getIsLeader()) {
                $scoutlist = ArrayHelper::map(Scoutrelation::find()->all(), 'id', 'scout.name');
            }
            return $this->render('create', [
                'model' => $model,
                'scoutlist' => $scoutlist,
            ]);
        }
    }

    public function actionCreateany()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post())) {

            $order = Yii::$app->request->post('Order');

            if ($model->save()) {
                return $this->redirect(['index', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            $scoutlist = ArrayHelper::map(Scout::find()->all(), 'id', 'name');
            return $this->render('create', [
                'model' => $model,
                'scoutlist' => $scoutlist,
            ]);
        }
    }


    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/order/index', 'id' => $model->id]);
        } else {
            if (Yii::$app->user->identity->getIsScout()) {
                $thisuser =  Yii::$app->user->getId();
                $scout = Scout::findOne(['userid' => $thisuser]);
                $scoutlist = ArrayHelper::map(Scout::findAll(['id' => $scout->id]), 'id', 'name');
            } elseif (Yii::$app->user->identity->getIsParent()) {
                $thisuser =  Yii::$app->user->getId();
                $thisparent = Scoutparent::findOne(['userid' => $thisuser]);
                $myscouts = Scoutrelation::find()->where(['parentid' => $thisparent->id])->all();
                $scoutlist = ArrayHelper::map(Scout::find()->where(['id' => ArrayHelper::getColumn($myscouts, 'scoutid')])->all(),'id','name');
            } elseif (Yii::$app->user->identity->getIsLeader()) {
                $scoutlist = ArrayHelper::map(Scoutrelation::find()->all(), 'id', 'scout.name');
            }
            return $this->render('update', [
                'model' => $model,
                'scoutlist' => $scoutlist,
            ]);
        }
    }

    /**
     * Deletes an existing Order model.
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
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
