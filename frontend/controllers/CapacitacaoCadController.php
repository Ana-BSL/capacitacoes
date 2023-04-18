<?php

namespace frontend\controllers;

use frontend\models\CapacitacaoRel;
use Yii;
use frontend\models\CapacitacaoCad;
use frontend\models\CapacitacaoEspec;
use frontend\models\UnidadeSaude;
use frontend\search\CapacitacaoCadSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * CapacitacaoCadController implements the CRUD actions for CapacitacaoCad model.
 */
class CapacitacaoCadController extends Controller
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
     * Lists all CapacitacaoCad models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CapacitacaoCadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionList()
    {
        $searchModel = new CapacitacaoCadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single CapacitacaoCad model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Capacitacao #" . $id,
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

    /**
     * Creates a new CapacitacaoCad model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionInscricao($id_capacitacao)
    {
        $request = Yii::$app->request;
        $model = new CapacitacaoEspec();
        $unidades = UnidadeSaude::getUnidades();
        $relacao = new CapacitacaoRel();
        $model->scenario = CapacitacaoEspec::SCENARIO_VALIDACAO_CPF;

        if ($model->load($request->post()) && $model->validate()) {

            $espectador = CapacitacaoEspec::find()->where(['cpf' => $model->cpf])->one();

            if ($espectador) {

                $capacitacaorel = CapacitacaoRel::find()->where(['id_espectador' => $espectador->id_espectador])
                ->andWhere(['id_capacitacao' => $id_capacitacao])->one();
                if($capacitacaorel){
                    return $this->redirect(['/capacitacao-espec/view', 'id' => $espectador->id_espectador]);
                }
                $relacao->id_capacitacao = $id_capacitacao;
                $relacao->id_espectador = $espectador->id_espectador;
                if ($relacao->save()) {
                    return $this->redirect(['/capacitacao-espec/view', 'id' => $espectador->id_espectador]);
                }
                else{
                    return $this->render('/capacitacao-espec/inscricao', [
                        'model' => $model,
                        'unidades' => $unidades,
                    ]);
                }
            } else {
                return $this->redirect(['/capacitacao-cad/cadastrar', 'id_capacitacao' => $id_capacitacao, 'cpf' => $model->cpf]);
            }
        } else {
            return $this->render('/capacitacao-espec/inscricao', [
                'model' => $model,
                'unidades' => $unidades,
            ]);
        }
    }

    public function actionCadastrar($id_capacitacao = null, $cpf)
    {
        $request = Yii::$app->request;
        $model = new CapacitacaoEspec();
        $model->cpf = $cpf;
        $unidades = UnidadeSaude::getUnidades();
        $relacao = new CapacitacaoRel();
        $model->scenario = CapacitacaoEspec::SCENARIO_VALIDACAO_TOTAL;

        if ($model->load($request->post()) && $model->validate()) {

            $transaction = Yii::$app->db->beginTransaction();

            try {
                $model->save();
                $relacao->id_capacitacao = $id_capacitacao;
                $relacao->id_espectador = $model->id_espectador;
                $relacao->save();

                $transaction->commit();
            } catch (\Exception $e) {
                // Se ocorrer algum erro, você pode dar rollback na transação
                $transaction->rollBack();

                return $this->render('/capacitacao-espec/cadastrar', [
                    'model' => $model,
                    'unidades' => $unidades,
                ]);
            }

            return $this->redirect(['/capacitacao-espec/view', 'id' => $model->id_espectador]);
        } else {
            return $this->render('/capacitacao-espec/cadastrar', [
                'model' => $model,
                'unidades' => $unidades,
            ]);
        }
    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new CapacitacaoCad();
        $unidades = UnidadeSaude::getUnidades();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new CapacitacaoCad",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'unidades' => $unidades,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Create new CapacitacaoCad",
                    'content' => '<span class="text-success">Create CapacitacaoCad success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                ];
            } else {
                return [
                    'title' => "Create new CapacitacaoCad",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'unidades' => $unidades,
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
                return $this->redirect(['view', 'id' => $model->id_capacitacao]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'unidades' => $unidades,
                ]);
            }
        }
    }

    /**
     * Updates an existing CapacitacaoCad model.
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
                    'title' => "Update CapacitacaoCad #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'unidades' => $unidades,

                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "CapacitacaoCad #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                        'unidades' => $unidades,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Update CapacitacaoCad #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'unidades' => $unidades,
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
                return $this->redirect(['view', 'id' => $model->id_capacitacao]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'unidades' => $unidades,
                ]);
            }
        }
    }

    /**
     * Delete an existing CapacitacaoCad model.
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
     * Delete multiple existing CapacitacaoCad model.
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
     * Finds the CapacitacaoCad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CapacitacaoCad the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CapacitacaoCad::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
