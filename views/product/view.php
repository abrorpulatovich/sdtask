<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Maxsulotlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'id',
            'name',
            'price',
            'quantity',
            [
                'attribute' => 'date',
                'value' => function($model) {
                    return date('d.m.Y', strtotime($model->date));
                }
            ],
            [
                'attribute' => 'batch_number',
                'value' => function($model) {
                    return ($model->batch_number)? $model->batch_number: "<span class='text-danger'><i>Qiymatlanmagan</i></span>";
                },
                'filterInputOptions' => ['class' => 'form-control'],
                'format' => 'html'
            ]
        ]
    ]) ?>

</div>
