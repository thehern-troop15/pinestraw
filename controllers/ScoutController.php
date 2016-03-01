<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Scout;
use app\models\Scoutparent;
use app\models\Scoutrelation;
use app\models\ScoutSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ScoutController implements the CRUD actions for Scout model.
 */
class ScoutController extends Controller
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
                        'actions' => ['create'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['viewme','update'],
                        'allow' => true,
                        'roles' => ['scout','parent','leader'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['parent','leader'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['leader'],
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
     * Lists all Scout models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ScoutSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Scout model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewme()
    {
        $thisuser =  Yii::$app->user->getId();
        $model = Scout::findOne(['userid' => $thisuser]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/site/index']);
        }
        return $this->render('update', [
            'model' => $model,
            'where' => 'fromscout',
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Scout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Scout();

        if ($model->load(Yii::$app->request->post())) {

            if (!Yii::$app->user->isGuest && !Yii::$app->user->identity->getIsScout() && !Yii::$app->user->identity->getIsParent() ) {
                $auth = Yii::$app->authManager;
                $authorRole = $auth->getRole('scout');
                $auth->assign($authorRole, Yii::$app->user->getId());

            }

            $model->setAttribute('userid', Yii::$app->user->getId());

            if ($model->save()) {
                if (Yii::$app->user->identity->getIsParent() ) {
                    $scoutrelation = new Scoutrelation();
                    $scoutrelation->scoutid = $model->id;

                    $thisuser =  Yii::$app->user->getId();
                    $parent = Scoutparent::findOne(['userid' => $thisuser]);
                    $scoutrelation->parentid = $parent->id;
                    $scoutrelation->save();
                }
                $post = Yii::$app->request->post();
                if ($post['where'] == 'fromparent') {
                    return $this->redirect(['/scoutrelation/create']);
                } else {
                    return $this->redirect(['/site/index']);
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            $context = Yii::$app->request->get();
            if (in_array('where', $context) && $context['where'] == 'fromparent') {
                return $this->render('create', [
                    'model' => $model,
                    'where' => 'fromparent',
                ]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'where' => '',
                ]);
            }
        }
    }

    /**
     * Updates an existing Scout model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'where' => '',
            ]);
        }
    }

    /**
     * Deletes an existing Scout model.
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
     * Finds the Scout model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Scout the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Scout::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
