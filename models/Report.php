<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\Query;

use app\models\Product;
use app\models\Sell;

class Report
{
    public static function product($range_dates = null)
    {
        $condition = [];
        $from_condition = [];
        $to_condition = [];
        $from = null;
        $to = null;

        if($range_dates) {
            $from = trim(explode('-', $range_dates)[0]);
            $to = trim(explode('-', $range_dates)[1]);

            $from_explode = explode('/', $from);
            $from = $from_explode[2] . '-' . $from_explode[0] . '-' . $from_explode[1] . ' 23:59:00';

            $to_explode = explode('/', $to);
            $to = $to_explode[2] . '-' . $to_explode[0] . '-' . $to_explode[1] . ' 23:59:00';

            if($from == $to) {
                $condition = ['like', 'sell.sell_date', $from_explode[2] . '-' . $from_explode[0] . '-' . $from_explode[1]];
            } else {
                $from_condition = ['>', 'sell.sell_date', $from];
                $to_condition = ['<', 'sell.sell_date', $to];
            }
        } else {
            $condition = ['like', 'sell.sell_date', date('Y-m-d')];
        }

        $query = new Query();
        $query->select([
            'product.id as product_id',
            'product.name as product_name',
            'product.status as product_status',
            'product.quantity as product_quantity',
            'product.date as product_date',
            'product.price as product_price',
            'product.batch_number as product_batch_number',
            'sell.*'
        ])
            ->from('sell')
            ->innerJoin('product', 'sell.product_id = product.id')
            ->where($condition)
            ->andWhere($from_condition)
            ->andWhere($to_condition);
        $command = $query->createCommand();
        $data = $command->queryAll();

        return [
            'from' => $from,
            'to' => $to,
            'data' => $data
        ];
    }   
}
