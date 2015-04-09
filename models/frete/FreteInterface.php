<?php
/**
 * Created by PhpStorm.
 * User: Vinicius Schettino
 * Date: 07/04/2015
 * Time: 22:12
 */

namespace app\models\frete;


interface FreteInterface
{
    public function getValor();

    public function getLabel();

    public function getPrazo();

    public function getId();

    public function getTitle();

    public function run();
}