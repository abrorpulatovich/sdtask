<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class ReportController extends Controller
{
    public function actionProduct()
    {
        return $this->render('product');
    }

}
