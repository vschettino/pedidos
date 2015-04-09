<?php
/**
 * Created by PhpStorm.
 * User: Vinicius Schettino
 * Date: 07/04/2015
 * Time: 22:08
 */

namespace app\models\status;


class PagamentoConfirmadoStatus extends AbertoStatus
{
    public function getLabel()
    {
        return "Pagamento Confirmado";
    }

    public function abrir()
    {
        return "Pedido já aberto!";
    }

    public function enviar()
    {
        return new EnviadoStatus();
    }

    public function aprovarPgto()
    {
        return "Pagamento já aprovado!";
    }

    public function entregar()
    {
        return "Envie o produto antes de confirmar a entrega!";
    }

    public function cancelar()
    {
        return new CanceladoStatus();
    }
}