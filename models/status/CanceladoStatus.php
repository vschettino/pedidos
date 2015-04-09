<?php
/**
 * Created by PhpStorm.
 * User: Vinicius Schettino
 * Date: 07/04/2015
 * Time: 22:06
 */

namespace app\models\status;


class CanceladoStatus extends ConcluidoStatus implements StatusInterface
{

    public function getLabel()
    {
        return "Cancelado";
    }
}