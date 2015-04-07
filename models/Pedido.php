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
            [['id', 'transportadora_id'], 'required'],
            [['id', 'transportadora_id'], 'integer'],
            [['data'], 'safe']
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
        return $this->hasMany(Produto::className(), ['id' => 'produto_id'])->viaTable('pedido_produto', ['pedido_id' => 'id']);
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
        return $this->hasMany(Status::className(), ['id' => 'status_id'])->viaTable('status_pedido', ['pedido_id' => 'id']);
    }
}
