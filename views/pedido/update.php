<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = 'Update Pedido: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = [
    'label' => $model->id,
    'url' => ['view', 'id' => $model->id, 'transportadora_id' => $model->transportadora_id]
];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pedido-update row">
    <div class="form-group ">

        <h1><?= Html::encode(" Status Atual: " . $model->statusAtual->nome) ?></h1>
        <?= Html::hiddenInput('pedido_id', $model->id, ['id' => 'pedido_id']) ?>
        <?= Html::dropDownList('status_id', null,
            \yii\helpers\ArrayHelper::map(\app\models\Status::find()->all(), 'codigo', 'nome'),
            ['id' => 'status_id']) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Mudar Status do Pedido', ['class' => 'btn btn-primary mudar-status']) ?>
    </div>
    <div class="well log-mudancas">

    </div>
</div>
