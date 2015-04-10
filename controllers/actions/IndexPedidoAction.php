<?php
namespace app\controllers\actions;

//use app\models\PedidoSearch;
use app\models\PedidoSearch;
use Yii;
use yii\base\Action;

class IndexPedidoAction extends Action
{

    public function run()
    {
        $searchModel = new PedidoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->controller->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


}
