<?php

namespace frontend\controllers;

use frontend\models\CapacitacaoRel;
use frontend\models\UnidadeSaude;
use frontend\search\CapacitacaoCadSearch;
use frontend\search\CapacitacaoRelSearch;
use Yii;
use frontend\models\CapacitacaoEspec;
use frontend\search\CapacitacaoEspecSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * CapacitacaoEspecController implements the CRUD actions for CapacitacaoEspec model.
 */
class CapacitacaoEspecController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all CapacitacaoEspec models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CapacitacaoEspecSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single CapacitacaoEspec model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "CapacitacaoEspec #" . $id,
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    public function actionBuscar()
    {
        $request = Yii::$app->request;
        $model = new CapacitacaoEspec(['scenario' => CapacitacaoEspec::SCENARIO_VALIDACAO_CPF]);
        $unidades = UnidadeSaude::getUnidades();

        if ($model->load($request->post()) && $model->validate()) {
            $espectador = CapacitacaoEspec::findOne(['cpf' => $model->cpf]);

            if ($espectador) {
                return $this->redirect(['minhas-inscricoes', 'id' => $espectador->id_espectador]);
            }
        }

        return $this->render('/capacitacao-espec/inscricao', [
            'model' => $model,
            'unidades' => $unidades,
        ]);
    }

    public function actionMinhasInscricoes($id)
    {
        $capacitacoesRel = CapacitacaoRel::find()->where(['id_espectador' => $id])->all();
        $capacitacoesIds = ArrayHelper::getColumn($capacitacoesRel, 'id_capacitacao');

        $searchModel = new CapacitacaoCadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['id_capacitacao' => $capacitacoesIds]);

        return $this->render('minhas-inscricoes', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new CapacitacaoEspec model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new CapacitacaoEspec();
        $unidades = UnidadeSaude::getUnidades();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new CapacitacaoEspec",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'unidades' => $unidades
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post()) && $model->save()) {
                $existingModel = CapacitacaoEspec::find()->where(['cpf' => $model->cpf])->one();
                if ($existingModel) {
                    // CPF already exists in the database, display an error message
                    Yii::$app->session->setFlash('error', 'CPF already exists in the database.');
                    return [
                        'title' => "Create new CapacitacaoEspec",
                        'content' => $this->renderAjax('create', [
                            'model' => $model,
                            'unidades' => $unidades
                        ]),
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                    ];
                } else if ($model->save()) {
                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => "Create new CapacitacaoEspec",
                        'content' => '<span class="text-success">Create CapacitacaoEspec success</span>',
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                    ];
                } else {
                    return [
                        'title' => "Create new CapacitacaoEspec",
                        'content' => $this->renderAjax('create', [
                            'model' => $model,
                            'unidades' => $unidades
                        ]),
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                    ];
                }                                                                                                                                                       
            } else {
                return [
                    'title' => "Create new CapacitacaoEspec",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'unidades' => $unidades
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_espectador]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'unidades' => $unidades
                ]);
            }
        }
    }

    /**
     * Updates an existing CapacitacaoEspec model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $unidades = UnidadeSaude::getUnidades();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update CapacitacaoEspec #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'unidades' => $unidades
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "CapacitacaoEspec #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                        'unidades' => $unidades
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Update CapacitacaoEspec #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'unidades' => $unidades
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_espectador]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'unidades' => $unidades
                ]);
            }
        }
    }

    /**
     * Delete an existing CapacitacaoEspec model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Delete multiple existing CapacitacaoEspec model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the CapacitacaoEspec model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CapacitacaoEspec the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CapacitacaoEspec::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
