<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property integer $id
 * @property string $nome
 * @property integer $aberto
 * @property string $codigo
 *
 * @property StatusPedido[] $statusPedidos
 * @property Pedido[] $pedidos
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['aberto'], 'integer'],
            [['nome'], 'string', 'max' => 45],
            [['codigo'], 'string', 'max' => 15]
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
            'aberto' => 'Aberto',
            'codigo' => 'Codigo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusPedidos()
    {
        return $this->hasMany(StatusPedido::className(), ['status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['id' => 'pedido_id'])->viaTable('status_pedido', ['status_id' => 'id']);
    }
}
