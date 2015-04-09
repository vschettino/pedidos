<?php
/**
 * Created by PhpStorm.
 * User: Vinicius Schettino
 * Date: 07/04/2015
 * Time: 22:12
 */

namespace app\models\frete;


use Yii;

abstract class CorreiosFrete implements FreteInterface
{

    public $valor;
    public $prazo;
    public $formato = 1;
    public $diametro = 0;
    public $maoPropria = 'n';
    public $valorDeclarado = 0;
    public $avisoRecebimento = 'n';
    public $codigoServico;
    public $retorno = 'xml';
    public $wsUrl = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';

    public function run()
    {
        $url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=$this->cepOrigem&sCepDestino=$this->cepDestino&nVlPeso=$this->peso&nCdFormato=$this->formato&nVlComprimento=$this->comprimento&nVlAltura=$this->altura&nVlLargura=$this->largura&nVlDiametro=$this->diametro&sCdMaoPropria=$this->maoPropria&sCdAvisoRecebimento=$this->avisoRecebimento&nCdServico=$this->codigoServico&StrRetorno=$this->retorno";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT,
            'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        $data = curl_exec($ch);
//        echo $url;die;
        curl_close($ch);
        $xml = simplexml_load_string($data);

        if ($xml == null || $xml->cServico->Erro != 0) {
            return false;
        }
        $xml = $xml->cServico;

        $this->valor = (float)str_replace(',', '.', $xml->Valor);
        $this->prazo = (string)$xml->PrazoEntrega;

        return true;
    }

    public function getPrazo()
    {
        return $this->prazo;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function getLabel()
    {
        return $this->getTitle() . ': ' . Yii::$app->formatter->asCurrency($this->getValor()) . '. Prazo: ' . $this->getPrazo() . ' dia(s) útil(eis)';
    }


}