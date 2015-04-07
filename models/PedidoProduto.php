<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido_produto".
 *
 * @property integer $pedido_id
 * @property integer $produto_id
 *
 * @property Produto $produto
 * @property Pedido $pedido
 */
class PedidoProduto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedido_produto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pedido_id', 'produto_id'], 'required'],
            [['pedido_id', 'produto_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pedido_id' => 'Pedido ID',
            'produto_id' => 'Produto ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduto()
    {
        return $this->hasOne(Produto::className(), ['id' => 'produto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedido()
    {
        return $this->hasOne(Pedido::className(), ['id' => 'pedido_id']);
    }
}
