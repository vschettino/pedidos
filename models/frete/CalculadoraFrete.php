<?php
/**
 * Created by PhpStorm.
 * User: Vinicius Schettino
 * Date: 08/04/2015
 * Time: 20:23
 */

namespace app\models\frete;


use Yii;
use yii\base\ErrorException;
use yii\web\ConflictHttpException;
use yii\web\ServerErrorHttpException;

class CalculadoraFrete
{
    public $classes = [];
    public $params;

    public function getFretes()
    {
        $fretes = [];
        foreach ($this->classes as $c) {
            $cName = 'app\models\frete\\' . $c . 'Frete';
            if (!class_exists($cName)) {
                throw new ServerErrorHttpException("Erro ao calcular o frete $cName");
            }
            $this->params['class'] = $cName;
            $frete = Yii::createObject($this->params);
            if ($frete && $frete->run()) {
                $fretes[] = $frete;
            }
        }

        return $fretes;
    }

}