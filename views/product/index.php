<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search_models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Maxsulotlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'name',
                'value' => 'name',
                'filterInputOptions' => ['class' => 'form-control']
            ],
            [
                'attribute' => 'price',
                'value' => 'price',
                'filterInputOptions' => ['class' => 'form-control']
            ],
            [
                'attribute' => 'quantity',
                'value' => 'quantity',
                'filterInputOptions' => ['class' => 'form-control']
            ],
            [
                'attribute' => 'date',
                'value' => function($model) {
                    return date('d.m.Y', strtotime($model->date));
                },
                'filter' => DatePicker::widget([
                    'id' => 'date',
                    'name' => 'ProductSearch[date]',
                    'options' => ['placeholder' => '---'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]),
                'filterInputOptions' => ['class' => 'form-control']
            ],
            [
                'attribute' => 'batch_number',
                'value' => function($model) {
                    return ($model->batch_number)? $model->batch_number: "<span class='text-danger'><i>Qiymatlanmagan</i></span>";
                },
                'filterInputOptions' => ['class' => 'form-control'],
                'format' => 'html'
            ],
            ['class' => 'yii\grid\ActionColumn']
        ]
    ]); ?>
</div>
