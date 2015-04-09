<?php
/**
 * Created by PhpStorm.
 * User: Vinicius Schettino
 * Date: 07/04/2015
 * Time: 22:13
 */

namespace app\models\frete;


class PacFrete extends CorreiosFrete
{
    public $codigoServico = 41106;

    public function getId()
    {
        return 1;
    }

    public function getTitle()
    {
        return 'Pac';
    }
}