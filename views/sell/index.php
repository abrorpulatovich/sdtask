<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search_models\SellSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sotilgan mahsulotlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sell-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?php if(Yii::$app->session->hasFlash('successfully_sold')): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success"><?= Yii::$app->session->getFlash('successfully_sold') ?></div>
            </div>
        </div>
    <?php endif ?>

    <?php if(Yii::$app->session->hasFlash('successfully_deleted')): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success"><?= Yii::$app->session->getFlash('successfully_deleted') ?></div>
            </div>
        </div>
    <?php endif ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'product_id',
                'value' => function($model) {
                    return ($model->product and $model->product->batch_number)? $model->product->name . ' (' . $model->product->batch_number . ')': $model->product->name;
                },
                'filter' => $products
            ],
            [
                'attribute' => 'sell_price',
                'value' => function($model) {
                    return number_format($model->sell_price, 2);
                },
                'filterInputOptions' => ['class' => 'form-control']
            ],
            'sell_quantity',
            [
                'attribute' => 'sell_date',
                'value' => function($model) {
                    return date('d.m.Y H:i:s', strtotime($model->sell_date));
                },
                'filter' => DatePicker::widget([
                    'id' => 'sell_date',
                    'name' => 'SellSearch[sell_date]',
                    'options' => ['placeholder' => '---'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]),
                'filterInputOptions' => ['class' => 'form-control']
            ],
            [
                'attribute' => 'sell_batch_number',
                'value' => function($model) {
                    return ($model->sell_batch_number)? $model->sell_batch_number: "<span class='text-danger'><i>Qiymatlanmagan</i></span>";
                },
                'filterInputOptions' => ['class' => 'form-control'],
                'format' => 'html'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
