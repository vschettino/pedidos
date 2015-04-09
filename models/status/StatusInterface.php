<?php
/**
 * Created by PhpStorm.
 * User: Vinicius Schettino
 * Date: 07/04/2015
 * Time: 22:05
 */

namespace app\models\status;


interface StatusInterface
{
    public function getLabel();

    public function abrir();

    public function enviar();

    public function aprovarPgto();

    public function entregar();

    public function cancelar();

}