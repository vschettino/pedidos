<?php
/**
 * Created by PhpStorm.
 * User: Vinicius Schettino
 * Date: 07/04/2015
 * Time: 22:08
 */

namespace app\models\status;


class EnviadoStatus
{
    public function getLabel()
    {
        return "Enviado";
    }

    public function abrir()
    {
        return "Pedido já aberto!";
    }

    public function enviar()
    {
        return "Pedido já enviado!";
    }

    public function aprovarPgto()
    {
        return "Pagamento já aprovado!";
    }

    public function entregar()
    {
        return new EntregueStatus();
    }

    public function cancelar()
    {
        return new CanceladoStatus();
    }
}