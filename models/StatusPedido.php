<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status_pedido".
 *
 * @property integer $status_id
 * @property integer $pedido_id
 * @property string $dt_ref
 *
 * @property Pedido $pedido
 * @property Status $status
 */
class StatusPedido extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status_pedido';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_id', 'pedido_id'], 'required'],
            [['status_id', 'pedido_id'], 'integer'],
            [['dt_ref'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status_id' => 'Status ID',
            'pedido_id' => 'Pedido ID',
            'dt_ref' => 'Dt Ref',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedido()
    {
        return $this->hasOne(Pedido::className(), ['id' => 'pedido_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }
}
