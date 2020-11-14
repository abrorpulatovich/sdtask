<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Product;
use kartik\select2\Select2;
use yii\web\View;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Sell */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="sell-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'product_id')->widget(Select2::classname(), [
                'data' => Product::_all(),
                'options' => ['placeholder' => '---'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'sell_price')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'sell_quantity')->textInput(['type' => 'number']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?php
                echo '<label>Sanasi</label>';
                echo DatePicker::widget([
                    'name' => 'Sell[sell_date]',
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
            <?= $form->field($model, 'sell_batch_number')->textInput(['maxlength' => true]) ?>
        </div>
    </div>    

    <div class="row">
        <div class="col-md-4">
            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>    

    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJsFile("/js/sell.js", ['position' => View::POS_END]) ?>
