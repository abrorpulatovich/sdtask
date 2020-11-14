<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'quantity')->textInput(['type' => 'number']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?php
                echo '<label for="date">Sanasi</label>';
                echo DatePicker::widget([
                    'id' => 'date',
                    'name' => 'Product[date]',
                    'value' => date('Y-m-d'),
                    'options' => ['placeholder' => '---'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);
            ?>
        </div>
    </div>
    
    <br>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'batch_number')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
