<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sell */

$this->title = 'Sotish';
$this->params['breadcrumbs'][] = ['label' => 'Sotilgan mahsulotlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sell-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
