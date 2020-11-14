<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sell */

$this->title = $model->product->name;
$this->params['breadcrumbs'][] = ['label' => 'Sotilgan mahsulotlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sell-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Tahrirlash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Siz rostdan ham ushbu elementni o`chirmoqchimisiz?',
                'method' => 'post',
            ]
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            [
                'attribute' => 'product_id',
                'value' => function($model) {
                    return $model->product->name;
                }
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
                }
            ],
            [
                'attribute' => 'sell_batch_number',
                'value' => function($model) {
                    return ($model->sell_batch_number)? $model->sell_batch_number: "<span class='text-danger'><i>Qiymatlanmagan</i></span>";
                },
                'filterInputOptions' => ['class' => 'form-control'],
                'format' => 'html'
            ]
        ],
    ]) ?>

</div>
