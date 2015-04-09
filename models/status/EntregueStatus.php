<?php
/**
 * Created by PhpStorm.
 * User: Vinicius Schettino
 * Date: 07/04/2015
 * Time: 22:10
 */

namespace app\models\status;


class EntregueStatus extends ConcluidoStatus
{

    public function getLabel()
    {
        return "Entregue";
    }
}