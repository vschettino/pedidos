<?php
namespace app\controllers\actions;

use app\models\Produto;
use Yii;
use yii\base\Action;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class CheckoutAction extends Action
{

    public function run($produto_id)
    {
        $ids = explode("|", $produto_id);

        if ($produto_id == null) {
            throw new BadRequestHttpException("Escolha Itens para efetuar o checkout");
        }
        $produtos = Produto::findAll($ids);
        if ($produtos == null) {
            throw new NotFoundHttpException("Produto(s) não encontrados!");
        }
        $fretes = $this->getFretes(
            Produto::getSomaConjunto($produtos, 'peso'),
            Produto::getSomaConjunto($produtos, 'altura'),
            Produto::getSomaConjunto($produtos, 'largura'),
            Produto::getSomaConjunto($produtos, 'comprimento')
        );

        return $this->controller->render('checkout', ['produtos' => $produtos, 'fretes' => $fretes]);

    }


    public function getFretes($peso, $altura, $largura, $comprimento)
    {
        return Yii::createObject([
            'class' => 'app\models\frete\CalculadoraFrete',
            'classes' => ['Pac', 'Sedex', 'JadLog'],
            'params' => [
                'cepOrigem' => Yii::$app->params['cepOrigem'],
                'cepDestino' => Yii::$app->params['cepDestino'],
                'peso' => $peso,
                'altura' => $altura,
                'largura' => $largura,
                'comprimento' => $comprimento,
            ]
        ])->getFretes();

    }

}
