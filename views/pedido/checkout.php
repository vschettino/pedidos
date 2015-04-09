<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;

$pedido = new \app\models\Pedido();
?>
<h1>Checkout</h1>
<h2>Meus Produtos</h2>
<div class="pedido-form">

    <?php $form = ActiveForm::begin(['action' => ['pedido/create']]); ?>
    <?php

    foreach ($produtos as $p) {
        echo Html::tag('div', $p, ['class' => 'well']);
        echo Html::hiddenInput('produto_id[' . $p->id . ']', $p->id);
    }
    ?>
    <h2>Formas de Frete</h2>

    <div class="well well-lg">
        <?php
        $labelFretes = [];
        foreach ($fretes as $f) {
            $labelFretes[$f->getId()] = $f->getLabel();
        }
        echo Html::radioList('frete_id', $fretes[0]->getId(), $labelFretes, ['separator' => '<br />']);

        ?>

    </div>
    <div class="form-group">
        <?= Html::submitButton('Criar Pedido',
            ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
