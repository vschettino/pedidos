<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transportadora".
 *
 * @property integer $id
 * @property string $nome
 * @property string $codigo
 *
 * @property Pedido[] $pedidos
 */
class Transportadora extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transportadora';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
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
            'codigo' => 'Codigo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['transportadora_id' => 'id']);
    }
}
