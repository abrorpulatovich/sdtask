<?php

namespace app\controllers;

use Yii;
use app\models\Sell;
use app\models\Product;
use app\models\search_models\SellSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SellController implements the CRUD actions for Sell model.
 */
class SellController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Sell models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SellSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $products = Product::_all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'products' => $products
        ]);
    }

    /**
     * Displays a single Sell model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Sell model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sell();
        $model->sell_date = date('Y-m-d H:i:s');

        if ($model->load(Yii::$app->request->post())) {

            $product = Product::findOne($model->product_id);
            if($product and $product->batch_number) {
                $product->quantity = ($product->quantity - $model->sell_quantity);
                $product->save(false);
                $model->save();
            } else {
                $this->sellByFIFO($model);
            }
            Yii::$app->session->setFlash('successfully_sold', 'Maxsulot muvaffaqiyatli sotildi');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    private function get_same_products($name, $price)
    {
        $products = Product::find()
                            ->where(['name' => $name])
                            ->andWhere(['batch_number' => ''])
                            ->andWhere(['price' => $price])
                            ->orderBy(['date' => SORT_ASC])
                            ->all();
        return $products;
    }

    private function sellByFIFO($model)
    {
        $product_id = $model->product_id;
        $product = Product::findOne($product_id);
        $products = $this->get_same_products($product->name, $product->price);

        $required_quantity = $model->sell_quantity;

        if($required_quantity < $product->quantity) {
            $product->quantity = ($product->quantity - $required_quantity);
            $product->save(false);
            $model->save();
        } else {
            $all_existing_quantity = 0;

            foreach($products as $p) {
                $all_existing_quantity += $p->quantity;
            }

            foreach($products as $p) {

                $sell = new Sell();
                $sell->product_id = $product->id;
                $sell->sell_price = $model->sell_price;
                $sell->sell_date = $model->sell_date;
                $sell->sell_batch_number = $model->sell_batch_number;

                if($required_quantity <= $all_existing_quantity) {

                    $sell->sell_quantity = $p->quantity;
                    $all_existing_quantity -= $p->quantity;
                    $last_p_quantity = $p->quantity;
                    $p->quantity = 0;

                } else {
                    $sell->sell_quantity = ($required_quantity - $last_p_quantity);
                    $all_existing_quantity -= $sell->sell_quantity;
                    $p->quantity = $all_existing_quantity;
                }
                $p->save(false);
                $sell->save(false);
            }
        }
    }

    // 100 + 200 = 300
    // 250
    // 200
    // 150
    
    // 200
    // 250

    /**
     * Updates an existing Sell model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Sell model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('successfully_deleted', 'Sotuv muvaffaqiyatli o\'chirildi');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Sell model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sell the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sell::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCheckCount($product_id, $sell_quantity)
    {
        $product = Product::findOne($product_id);

        if($product and $product->batch_number) {
            if($product->quantity < $sell_quantity) {
                $result = [
                    'success' => false,
                    'message' => 'Narxi ' . $product->price . ' so\'m bo\'lgan ' . $product->name . 'dan omborda jami ' . $product->quantity . ' ta qolgan'
                ];
            }
        } elseif($product and !$product->batch_number) {
            $products = $this->get_same_products($product->name, $product->price);
            $all_existing_quantity = 0;
    
            foreach($products as $p) {
                $all_existing_quantity += $p->quantity;
            }

            if($all_existing_quantity < $sell_quantity) {
                $result = [
                    'success' => false,
                    'message' => 'Narxi ' . $product->price . ' so\'m bo\'lgan ' . $product->name . 'dan omborda jami ' . $all_existing_quantity . ' ta qolgan'
                ];
            }
        }
        
        echo json_encode($result);
    }
}
