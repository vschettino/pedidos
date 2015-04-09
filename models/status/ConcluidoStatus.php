<?php
/**
 * Created by PhpStorm.
 * User: Vinicius Schettino
 * Date: 07/04/2015
 * Time: 22:06
 */

namespace app\models\status;


abstract class ConcluidoStatus implements StatusInterface
{
    public function abrir()
    {
        return "Pedido {$this->getLabel()}, impossível reabrir";
    }

    public function enviar()
    {
        return "Pedido {$this->getLabel()}, impossível reenviar";
    }

    public function aprovarPgto()
    {
        return "Pedido {$this->getLabel()}, impossível Aprovar Pagamento";
    }

    public function entregar()
    {
        return "Pedido {$this->getLabel()}, impossível realizar entrega";
    }

    public function cancelar()
    {
        return "Pedido {$this->getLabel()}, impossível Cancelar";
    }
}