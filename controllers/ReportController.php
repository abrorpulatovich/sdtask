<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\Report;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class ReportController extends Controller
{
    public function actionProduct($range_dates = null)
    {
        $report = Report::product($range_dates);
        $data = $report['data'];
        $from = $report['from'];
        $to = $report['to'];

        return $this->render('product', compact('data', 'from', 'to'));
    }
}
