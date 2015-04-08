<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "produto".
 *
 * @property integer $id
 * @property string $nome
 * @property string $descricao
 * @property double $valor
 * @property integer $qt_estoque
 * @property integer $categoria_id
 * @property integer $peso
 * @property integer $altura
 * @property integer $largura
 * @property integer $comprimento
 *
 * @property PedidoProduto[] $pedidoProdutos
 * @property Pedido[] $pedidos
 * @property Categoria $categoria
 */
class Produto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'produto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'valor', 'qt_estoque', 'categoria_id'], 'required'],
            [['valor'], 'number'],
            [['qt_estoque', 'categoria_id', 'peso', 'altura', 'largura', 'comprimento'], 'integer'],
            [['nome'], 'string', 'max' => 255],
            [['descricao'], 'string', 'max' => 400]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
            'valor' => 'Valor',
            'qt_estoque' => 'Qt Estoque',
            'categoria_id' => 'Categoria ID',
            'peso' => 'Peso',
            'altura' => 'Altura',
            'largura' => 'Largura',
            'comprimento' => 'Comprimento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoProdutos()
    {
        return $this->hasMany(PedidoProduto::className(), ['produto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['id' => 'pedido_id'])->viaTable('pedido_produto', ['produto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'categoria_id']);
    }
}
