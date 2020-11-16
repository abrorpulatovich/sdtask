<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Product;
use yii\web\View;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Sell */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="sell-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'product_id')
                ->dropDownList(Product::_all(), [
                    'class' => 'form-control',
                    'style' => "width: 100%",
                    'prompt' => '---'
            ]) ?>
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
                echo '<label for="sell_date">Sanasi</label>';
                echo DateTimePicker::widget([
                    'id' => 'sell-sell_date',
                    'name' => 'Sell[sell_date]',
                    'options' => ['placeholder' => '---'],
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'format' => 'yyyy-MM-dd H:i:s',
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

<script src="/js/libs/sweetalert.min.js"></script>
<?php $this->registerJsFile("/js/sell.js", ['position' => View::POS_END]) ?>
