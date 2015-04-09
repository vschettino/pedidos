<?php
/**
 * Created by PhpStorm.
 * User: Vinicius Schettino
 * Date: 07/04/2015
 * Time: 22:20
 */

namespace app\models\frete;


use Yii;

class JadLogFrete implements FreteInterface
{

    public $valor;
    public $prazo;

    public function getValor()
    {
        return $this->valor;
    }


    public function getPrazo()
    {
        return $this->prazo;
    }

    public function getId()
    {
        return 3;
    }

    public function run()
    {
        $soma = $this->altura + $this->largura + $this->comprimento;
        $this->prazo = floor($soma / 50);
        $this->valor = $soma * 0.30;

        return true;

    }

    public function getTitle()
    {
        return 'JadLog SUPER Entrega';
    }

    public function getLabel()
    {
        return $this->getTitle() . ': ' . Yii::$app->formatter->asCurrency($this->getValor()) . '. Prazo: ' . $this->getPrazo() . ' dia(s) útil(eis)';
    }

}