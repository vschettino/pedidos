<?php
/**
 * Created by PhpStorm.
 * User: Vinicius Schettino
 * Date: 07/04/2015
 * Time: 22:08
 */

namespace app\models\status;


class AguardandoPagamentoStatus extends AbertoStatus
{

    public function getLabel()
    {
        return "Aguardando Pagamento";
    }

    public function abrir()
    {
        return "Pedido já aberto!";
    }

    public function enviar()
    {
        return "É Necessário aprovar o pagamento antes de enviar!";
    }

    public function aprovarPgto()
    {
        return new PagamentoConfirmadoStatus();
    }

    public function entregar()
    {
        return "É necessário enviar o produto antes de confirmar a entrega!";
    }

    public function cancelar()
    {
        return new CanceladoStatus();
    }
}