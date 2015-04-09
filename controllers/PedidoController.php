<?php

namespace app\controllers;

use app\models\PedidoProduto;
use app\models\StatusPedido;
use Yii;
use app\models\Pedido;
use app\models\PedidoSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PedidoController implements the CRUD actions for Pedido model.
 */
class PedidoController extends Controller
{


    public function actions()
    {

        return [
            'checkout' => [
                'class' => 'app\controllers\actions\CheckoutAction',
            ]
        ];

    }

    /**
     * Lists all Pedido models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PedidoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pedido model.
     * @param integer $id
     * @param integer $transportadora_id
     * @return mixed
     */
    public function actionView($id, $transportadora_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $transportadora_id),
        ]);
    }

    /**
     * Creates a new Pedido model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        ;
        $model = new Pedido();
        $model->data = date('Y-m-d');
        $model->transportadora_id = Yii::$app->request->post('frete_id');

        if ($model->save()) {
            $produtos = Yii::$app->request->post('produto_id');
            foreach ($produtos as $p) {
                $pp = new PedidoProduto();
                $pp->pedido_id = $model->id;
                $pp->produto_id = $p;
                $pp->save();
            }
            $ps = new StatusPedido();
            $ps->pedido_id = $model->id;
            $ps->dt_ref = date('Y-m-d');
            $ps->status_id = 1;
            $ps->save();
            Yii::$app->session->setFlash('success', ['Pedido Criado Com Sucesso']);
        } else {
            Yii::$app->session->setFlash('error', ['Não Foi possível cadastrar seu pedido']);
        }

        $this->redirect(['index']);
    }

    /**
     * Updates an existing Pedido model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $transportadora_id
     * @return mixed
     */
    public function actionUpdate()
    {

    }

    /**
     * Deletes an existing Pedido model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $transportadora_id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pedido model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $transportadora_id
     * @return Pedido the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pedido::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
