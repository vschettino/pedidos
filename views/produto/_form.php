<?php

use app\models\Categoria;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Produto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => 400]) ?>

    <?= $form->field($model, 'valor')->textInput() ?>

    <?= $form->field($model, 'qt_estoque')->textInput() ?>

    <?= $form->field($model, 'categoria_id')->dropDownList(\yii\helpers\ArrayHelper::map(Categoria::find()->all(),
        'id', 'nome')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
