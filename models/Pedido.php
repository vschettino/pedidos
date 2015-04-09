<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido".
 *
 * @property integer $id
 * @property string $data
 * @property integer $transportadora_id
 *
 * @property Transportadora $transportadora
 * @property PedidoProduto[] $pedidoProdutos
 * @property Produto[] $produtos
 * @property StatusPedido[] $statusPedidos
 * @property Status[] $statuses
 */
class Pedido extends \yii\db\ActiveRecord
{
    public $_statusHandler;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedido';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transportadora_id'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Data',
            'transportadora_id' => 'Transportadora ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransportadora()
    {
        return $this->hasOne(Transportadora::className(), ['id' => 'transportadora_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoProdutos()
    {
        return $this->hasMany(PedidoProduto::className(), ['pedido_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(Produto::className(), ['id' => 'produto_id'])->viaTable('pedido_produto',
            ['pedido_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusPedido()
    {
        return $this->hasMany(StatusPedido::className(), ['pedido_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasMany(Status::className(), ['id' => 'status_id'])->viaTable('status_pedido',
            ['pedido_id' => 'id']);
    }

    public function getStatusAtual()
    {
        return $this->hasMany(Status::className(), ['id' => 'status_id'])->viaTable('status_pedido',
            ['pedido_id' => 'id'])->innerJoinWith('statusPedidos')->orderBy('dt_ref DESC')->one();
    }

    public function afterFind()
    {
        $stausHandlerCName = str_replace(" ", "", $this->statusAtual->nome);
        $stausHandlerCName = 'app\models\status\\' . $stausHandlerCName . "Status";
        $this->_statusHandler = new $stausHandlerCName();
    }

    public function getLabel()
    {
        return $this->_statusHandler->getLabel();
    }

    public function abrir()
    {
        return $this->mudaStatus($this->_statusHandler->abrir(), 1);
    }

    public function aprovarPgto()
    {
        return $this->mudaStatus($this->_statusHandler->aprovarPgto(), 2);
    }

    public function enviar()
    {
        return $this->mudaStatus($this->_statusHandler->enviar(), 3);
    }


    public function entregar()
    {
        return $this->mudaStatus($this->_statusHandler->entregar(), 4);
    }

    public function cancelar()
    {
        return $this->mudaStatus($this->_statusHandler->cancelar(), 5);
    }

    public function mudaStatus($status, $status_id)
    {
        if (is_object($status)) {
            $sp = new StatusPedido();
            $sp->pedido_id = $this->id;
            $sp->status_id = $status_id;
            $sp->dt_ref = date('Y-m-d H:i:s');
            $sp->save();
//            $this->_statusHandler = $status;
        }

        return $status;
    }
}
