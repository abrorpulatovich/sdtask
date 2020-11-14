<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sell */

$this->title = 'Tahrirlash: ' . $model->product->name;
$this->params['breadcrumbs'][] = ['label' => 'Sotilgan mahsulotlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Tahrirlash';
?>
<div class="sell-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
