<?php
/**
 * Created by PhpStorm.
 * User: Vinicius Schettino
 * Date: 07/04/2015
 * Time: 22:13
 */

namespace app\models\frete;


class SedexFrete extends CorreiosFrete
{
    public $codigoServico = 40010;

    public function getId()
    {
        return 2;
    }

    public function getTitle()
    {
        return 'Sedex';
    }
}